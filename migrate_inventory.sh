#!/usr/bin/env bash
set -euo pipefail

# ============================================================================
#
# Utility for converting inventory.txt to the new SQLite database format.
#
# Requirements:
#  - bash
#  - sed
#  - sqlite3
#  - yq (which in itself requires jq, see also https://kislyuk.github.io/yq/)
#
# ============================================================================

DATABASE_FILE=${1:-inventory.db}
INVENTORY_FILE=${2:-content/inventar/inventory.txt}

if [ ! -f $INVENTORY_FILE ]; then
    echo "Inventory file $INVENTORY_FILE does not exist!"
    exit 1
fi

# Ask for confirmation if the database file already exists
if [ -f $DATABASE_FILE ]; then
    echo "File $DATABASE_FILE exists! This operation will delete all existing data."
    read -p "Continue? [y/n] " -n 1 -r
    echo ""
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        rm $DATABASE_FILE
        echo "Deleted $DATABASE_FILE"
    else
        echo "Aborted!"
        exit 1
    fi
fi

# Create the SQLite database
sqlite3 $DATABASE_FILE <<EOF
CREATE TABLE items (
    invnum INTEGER PRIMARY KEY AUTOINCREMENT,
    registered TEXT,
    manufacturer TEXT,
    model TEXT,
    amount INTEGER,
    name TEXT,
    location TEXT,
    locationdetail TEXT,
    owner TEXT,
    category TEXT,
    source TEXT,
    price TEXT,
    discharge TEXT,
    notes TEXT,
    internalpage TEXT,
    images TEXT
);
EOF

# Convert the inventory file to CSV and then import into SQLite
# Steps:
#  - create valid yaml by adding quotes around standalone ? values
#  - extract the Items section (the part from "Items:" to the next "----", without the "----")
#  - convert yaml to csv by iterating all items and converting nested arrays to strings
#  - import csv to previously created SQLite table
cat $INVENTORY_FILE \
    | sed 's|: ?|: "?"|g' \
    | sed -n '/Items:/,/----/{/----/!p}' \
    | yq --raw-output '
        .Items[]
        | [
            .invnum,
            .registered,
            .manufacturer,
            .model,
            .amount,
            .name,
            .location,
            .locationdetail,
            .owner,
            .category,
            .source,
            .price,
            .discharge,
            .notes,
            (.internalpage | tostring),
            (.images | tostring)
        ]
        | @csv
    ' \
    | sqlite3 -csv $DATABASE_FILE ".import /dev/stdin items"
