
- Excel has been giving me problem, all the date columns in the excel sheet is not saving well. Therefore you need to edit the format for the “date” column into a custom format “yyyy-mm-dd”

- One other known problem is that for certain files (album_table, composer_table), myphpadmin doesn’t recognize the last entry of the table. If an error of last entry not recorded, you need to add in manually by using “insert”


Please take note and follow the instructions when you load the data sets into mysql:

1. Load DDL_proj.sql - this will create all the tables

2. load the datasets (.csv files) according to this order:
	a. album
	b. singer
	c. composer
	d. song
	e. singerhassong
	f. composerhassong
	g. user
	h. purchase

** before loading the data, always open the file first, convert all date columns to the format “yyyy-mm-dd”
** manual input if the last row is not recognize

If you have problem, please let me know