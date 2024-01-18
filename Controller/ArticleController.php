<?php

declare(strict_types = 1);

class ArticleController
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        try {
            $query = "SELECT * FROM articles;";

            $statement = $this->databaseManager->connection->prepare($query);
            $statement->execute();
            $rawArticles = $statement->fetchAll();
    
            $articles = [];
            foreach ($rawArticles as $rawArticle) {
                // We are converting an article from a "dumb" array to a much more flexible class
                $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
            }
    
            return $articles;        
        } catch (Error $error) {
            echo $error;
        }
    }

    public function show()
    {
        $article = $this->findOne();

        require 'View/articles/show.php';
    }

    private function findOne()
    {
        try {
            $query = "SELECT * FROM articles where id = :id ;";

            $statement = $this->databaseManager->connection->prepare($query);

            $statement->bindParam(":id", $_GET["id"]);

            $statement->execute();
            $rawArticles = $statement->fetchAll();
    
            $article = new Article($rawArticles[0]['id'], $rawArticles[0]['title'], $rawArticles[0]['description'], $rawArticles[0]['publish_date']);
    
            return $article;        
        } catch (Error $error) {
            echo $error;
        }
        
    }
}