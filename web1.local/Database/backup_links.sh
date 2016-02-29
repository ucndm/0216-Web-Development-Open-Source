#!/bin/bash

suffix=$(date +%F)

mysqldump --defaults-extra-file=<(printf "[client]\nuser = %s\npassword = %s" "test_user" "test_user_pw") -h localhost links | gzip > $suffix.links.sql.gz