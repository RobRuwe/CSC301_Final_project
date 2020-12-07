/* Select customers where the username and password match those passed as parameters */
SELECT *
FROM project_users
WHERE username = :username