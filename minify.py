#!/usr/bin/env python

import os.path
import os
import string
import sys

input_dir = 'styles'
default_file = 'assets/main.css'
file_writer = open(default_file, 'w')
output = ''

for file_name in os.listdir(input_dir):
	current_file = open(input_dir + '/' + file_name, 'r')
	output += current_file.read()
	current_file.close();

# remove all the new lines
output = output.replace("\n", "")
output = output.replace("\t", "")
output = output.replace(" {", "{")
# remove all the double spaces
while '  ' in output:
  output = output.replace("  ", "")
#remove comments
while '/*' in output:
  open_comment = output.index('/*')
  close_comment = output.index('*/') + 2
  output = output[:open_comment] + output[close_comment:]


file_writer.write(output + "\n")
file_writer.close();