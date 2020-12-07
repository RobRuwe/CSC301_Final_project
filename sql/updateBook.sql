UPDATE project_books 
SET author = :author, title = :title, price = :price, url = :url, project_users_userID = :userID
WHERE isbn = :isbn