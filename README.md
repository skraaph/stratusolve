# Training Exercise #2
## OVERVIEW
This exercise will test your ability to create a basic PHP, MySQL, Javascript, Html based web
application, starting from scratch.
You will be required to setup a database and manage users and other sensitive data. This
exercise will test your ability to create a PHP web application that conforms to best practices.
## INSTRUCTION
Your project is described below with a task breakdown. Each task has a points allocation in
brackets to indicate the level of complexity and provide an overall score for the project.
1. Setup a MySQL database (5)
2. Create a “Users” table that will allow users to log in to your app. The following attributes
are required: FirstName, LastName, EmailAddress, Username & Password (5)
3. Create a “Posts” table that will contain posts by users of the app. This table should have
the following attributes as a minimum: PostTimeStamp, PostText, UserId (The Id of the
user that posted it) (5)
4. Create a login page where users can be authenticated (10)
5. Once they have logged in, they must be directed to the logged in homepage. On this
page they must see a list of “updates” or “posts” by other users and be able to post
something themselves for others to see (Similar to twitter) (20)
6. Users must be able to open another secure page that displays their information and
allows them to change anything (15)
7. Ensure that only logged in users can see any page that is not the login page. If they are
not logged in, redirect them to the login page with a message that states they are not
authenticated (5)
8. Security points: Take all security concerns into account when developing application.
Ensure that authentication is secure and that data is safe (25)



Set the parameters in the files config.php and db.php