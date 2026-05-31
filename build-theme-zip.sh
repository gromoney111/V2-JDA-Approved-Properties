#!/usr/bin/env bash
# build-theme-zip.sh
# Creates v2-jda-properties.zip ready to upload to WordPress.
#
# Usage:   bash build-theme-zip.sh
# Output:  ./v2-jda-properties.zip   (next to this script)

set -euo pipefail

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
SRC_DIR="$SCRIPT_DIR/wp-theme/v2-jda-properties"
OUT_FILE="$SCRIPT_DIR/v2-jda-properties.zip"

if [ ! -d "$SRC_DIR" ]; then
  echo "ERROR: theme folder not found at $SRC_DIR"
  exit 1
fi

rm -f "$OUT_FILE"

# Zip from the parent of the theme folder so the archive contains
# the v2-jda-properties/ directory at its root (required by WP).
( cd "$SCRIPT_DIR/wp-theme" && zip -r "$OUT_FILE" "v2-jda-properties" -x '*.DS_Store' -x '*.git*' )

echo
echo "Done.  Upload $OUT_FILE via wp-admin → Appearance → Themes → Add New → Upload Theme."
