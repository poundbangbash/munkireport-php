#!/bin/bash

MODULE_NAME="sentinelone"
MODULESCRIPT="sentinelone.py"
MODULE_CACHE_FILE="sentinelone.plist"
QUARANTINE_CACHE_FILE="sentinelone_quarantine.plist"

# Remove preflight script
rm -f "${MUNKIPATH}preflight.d/sentinelone.py"

# Remove cache file
rm -f "${CACHEPATH}${MODULE_CACHE_FILE}"
rm -f "${CACHEPATH}${QUARANTINE_CACHE_FILE}"
