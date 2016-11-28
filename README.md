# Islamic Quiz

Welcome to the Islamic Quiz repository! This application was aimed to mosques that wanted to have their quizzes for teaching islamic knowledge, however, it is a general project, which makes it possible to use it in other topics as well. In this repository you can find all the files needed to configure this project for your needs.

The interface is in Albanian Language, because it was intended for Albanian users.

##Description

	###Users
		The project only has admin users. Users' information and score is not stored anywhere in the system.
		Admins can add, edit, delete questions and admin users(If they have the priority).
		Admins with priority 1 can edit, delete other admins and also manage the questions.
		Admins with priority 2 can only edit their own data and manage the questions.

	### Questions
	 	Questions are either active or inactive. Only active questions show up in the quiz, the inactive questions show up in the admin panel.
		Questions are categorised into four categories:
		1. Fill in the blanks
		2. Open questions
		3. Multiple choice(A,B,C,D)
		4. Multiple choice(YES/NO)
		5. With images

		The questions are ordered by categories, you can change the order in the admin_pyetje.php file.

## Usage

	1. You will need to create a new database
	2. import the db.sql file
	3. add an admin username or use the dummy(username:1, password:'islamquiz')
	4. add the project to your server
	5. login as admin and start inserting questions

## Contributing

	1. Fork it ( https://github.com/[my-github-username]/mozaix/islamquiz/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

## License

### The MIT License (MIT)
Copyright (c) 2016 Mozaix

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.