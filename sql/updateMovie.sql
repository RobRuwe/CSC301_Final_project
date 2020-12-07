UPDATE project_movies 
SET title = :title, director = :director, lead_actor = :lead_actor, url = :url, project_users_userID = :userID
WHERE movieID = :movieID
    