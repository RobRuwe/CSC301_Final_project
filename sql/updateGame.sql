UPDATE project_games 
SET title = :title, studio = :studio, price = :price, url = :url, project_users_userID = :userID
WHERE gameID = :gameID