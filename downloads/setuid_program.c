#include <stdio.h>
#include <time.h>

int main(int argc, char *argv[])
{
	int ruid, euid;
	char score[128];

	if (argc != 3) {
		printf("Usage: setuid_program name SSN\n");
		exit(1);
	}

	time_t current_time = time(NULL);

	ruid = getuid ();
	euid = geteuid ();
	// This is to make sure the logging command will have
	// sufficient privilege.
	if (setreuid(euid, euid)){
		perror("setreuid");
	}

	char command[256];
	printf("Invalid user name or SSN.\n");
	sprintf(command, "echo \"%s: Invalid user name or SSN: %s,%s\"|cat >> error.log", 
			ctime(&current_time), argv[1], argv[2]);
 	if (system(command)){
		perror("Logging");
	}
}

