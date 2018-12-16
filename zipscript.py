#!/usr/bin/env python
import zipfile
import sys
import os

choice = input("Welcome to Zipscript please run this from the directory you will be working in\n Enter 1 to zip and 2 to unzip: ")
selection =int(choice)

if selection == 1:

    version = input("What version is this? (Please contact admin if unsure) :")

    def zip_folder(folder_path, output_path):
        """Zip the contents of an entire folder (with that folder included
        in the archive). Empty subfolders will be included in the archive
        as well.
        """
        parent_folder = os.path.dirname(folder_path)

        # Retrieve the paths of the folder contents.
        contents = os.walk(folder_path)
        try:
            zip_file = zipfile.ZipFile(output_path, 'w', zipfile.ZIP_DEFLATED)
            for root, folders, files in contents:
                # Include all subfolders, including empty ones.
                for folder_name in folders:
                    absolute_path = os.path.join(root, folder_name)
                    relative_path = absolute_path.replace(parent_folder + '\\',
                                                          '')
                    print "Adding '%s' to archive." % absolute_path
                    zip_file.write(absolute_path, relative_path)
                for file_name in files:
                    absolute_path = os.path.join(root, file_name)
                    relative_path = absolute_path.replace(parent_folder + '\\',
                                                          '')
                    print "Adding '%s' to archive." % absolute_path
                    zip_file.write(absolute_path, relative_path)
            print "'%s' created successfully." % output_path
        except IOError, message:
            print message
            sys.exit(1)
        except OSError, message:
            print message
            sys.exit(1)
        except zipfile.BadZipfile, message:
            print message
            sys.exit(1)
        finally:
            zip_file.close()

    ## TEST ##
    #if __name__ == '__main__':
    #Change the folder path here to the folder you want to zip
      #zip_folder(r'/var/www/html/zipdir',
                #   r'/home/stefan/testdirectory'+str(version)+'.zip')
    if __name__ == '__main__':
    #Change the folder path here to the folder you want to zip
      zip_folder(r'/var/www/html/weatherspot.com/public_html/zipdir',
                   r'/var/www/html/weatherspot.com/public_html/testdirectory'+str(version)+'.zip')
elif selection == 2:
    file = input("What version are we extracting: ")

    working = zipfile.ZipFile('home/christian/testdirectory'+str(file)+'.zip')
    working.extractall('home/christian/testdirectory1.zip')

working.close()
