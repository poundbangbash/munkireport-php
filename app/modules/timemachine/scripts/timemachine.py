#!/usr/bin/python
"""
extracts information about TimeMachine configuration and logs
"""

import sys
import os
import subprocess
import plistlib
import re

# Skip manual check
if len(sys.argv) > 1:
    if sys.argv[1] == 'manualcheck':
        print 'Manual check: skipping'
        exit(0)

# Create cache dir if it does not exist
cachedir = '%s/cache' % os.path.dirname(os.path.realpath(__file__))
if not os.path.exists(cachedir):
    os.makedirs(cachedir)

# Run tmutil destinationinfo -X and capture the xml output to parse
sp = subprocess.Popen(['tmutil', 'destinationinfo', '-X'], stdout=subprocess.PIPE)
out, err = sp.communicate()

plist = plistlib.readPlistFromString(out)
destinations = plist['Destinations']
result = ''
destinationCount = 0

# Examine destinations for information.  May have multiple destinations.
for destination in destinations:
    destinationCount += 1
    if destination.get('Kind') == "Network":
        try:
            result += "TM_LOCATION: " + destination['URL'] + '\n'
        except KeyError:
            result += "TM_LOCATION: Undetected" + '\n'
    elif destination.get('Kind') == "Local":
        try:
            result += "TM_LOCATION: " + destination['MountPoint'] + '\n'
        except KeyError:
            result += "TM_LOCATION: Not Mounted" + '\n'
    else:
        result += "TM_LOCATION: UNKNOWN" + '\n'

    result += "TM_KIND: " + destination['Kind'] + '\n'
    result += "TM_NAME: " + destination['Name'] + '\n'

# Write to disk
txtfile = open("%s/timemachine.txt" % cachedir, "w")
txtfile.write("TM_DESTINATIONS: " + str(destinationCount) + '\n')

# Filter the logs for the last run
logproc = subprocess.Popen(['syslog', '-F', '$((Time)(utc)) $Message', '-k', 'Sender', 'com.apple.backupd', '-k', 'Time', 'ge', '-7d'], stdout=subprocess.PIPE)
out, err = logproc.communicate()

#Use regex to capture a block of backup logs from "Starting automatic|manual backup to Backup completed|failed"
found = re.findall(r'([\d\-]* [\d:]*Z Starting \D* backup\n[\s\S]*?[\d\-]* [\d:]*Z Backup \D*\.)', out)

#Concatenate the found log block to the result
result += '\n' + found[-1] + '\n'

#Write out the result to file
txtfile.write(result.encode('utf-8'))
txtfile.close()
