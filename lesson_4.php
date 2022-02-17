<?php

abstract class DbFactory
{
    abstract public function createConnection(): Connection;

    abstract public function createRecrord(): Recrord;

    abstract public function createQueryBuiler(): QueryBuiler;

    public function combineConnectionRecrordQueryBuiler()
    {

        $connection = $this->createConnection();
        $recrord = $this->createRecrord();
        $queryBuiler = $this->createQueryBuiler();

        $recrord->anotherUsefulFunctionB($connection);
        $queryBuiler->anotherUsefulFunctionC($connection);
    }
}

class MySQLFactory extends DbFactory
{
    public function createConnection(): Connection
    {

        return new MySQLConnection();
    }

    public function createRecrord(): Recrord
    {

        return new MySQLRecrord();
    }

    public function createQueryBuiler(): QueryBuiler
    {

        return new MySQLQueryBuiler();
    }
}

class PostgreSQLFactory extends DbFactory
{
    public function createConnection(): Connection
    {

        return new PostgreSQLConnection();
    }

    public function createRecrord(): Recrord
    {

        return new PostgreSQLRecrord();
    }

    public function createQueryBuiler(): QueryBuiler
    {

        return new PostgreSQLQueryBuiler();
    }
}

class OracleFactory extends DbFactory
{
    public function createConnection(): Connection
    {

        return new OracleConnection();
    }

    public function createRecrord(): Recrord
    {

        return new OracleRecrord();
    }

    public function createQueryBuiler(): QueryBuiler
    {

        return new OracleQueryBuiler();
    }
}

interface Connection
{
    public function usefulFunctionA(): string;
}

class MySQLConnection implements Connection
{
    public function usefulFunctionA(): string
    {

        return "The result of the product A1.";
    }
}

class PostgreSQLConnection implements Connection
{
    public function usefulFunctionA(): string
    {

        return "The result of the product A2.";
    }
}

class OracleConnection implements Connection
{
    public function usefulFunctionA(): string
    {

        return "The result of the product A2.";
    }
}

interface Recrord
{
    public function usefulFunctionB(): string;

    public function anotherUsefulFunctionB(Connection $collaborator): string;
}

class MySQLRecrord implements Recrord
{
    public function usefulFunctionB(): string
    {

        return "The result of the product B1.";
    }

    public function anotherUsefulFunctionB(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the B1 collaborating with the ({$result})";
    }
}

class PostgreSQLRecrord implements Recrord
{
    public function usefulFunctionB(): string
    {

        return "The result of the product B2.";
    }

    public function anotherUsefulFunctionB(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the B2 collaborating with the ({$result})";
    }
}

class OracleRecrord implements Recrord
{
    public function usefulFunctionB(): string
    {

        return "The result of the product B2.";
    }

    public function anotherUsefulFunctionB(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the B2 collaborating with the ({$result})";
    }
}

interface QueryBuiler
{
    public function usefulFunctionC(): string;

    public function anotherUsefulFunctionC(Connection $collaborator): string;
}

class MySQLQueryBuiler implements QueryBuiler
{
    public function usefulFunctionC(): string
    {

        return "The result of the product C1.";
    }

    public function anotherUsefulFunctionC(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the C1 collaborating with the ({$result})";
    }
}

class PostgreSQLQueryBuiler implements QueryBuiler
{
    public function usefulFunctionC(): string
    {

        return "The result of the product C2.";
    }

    public function anotherUsefulFunctionC(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the C2 collaborating with the ({$result})";
    }
}

class OracleQueryBuiler implements QueryBuiler
{
    public function usefulFunctionC(): string
    {

        return "The result of the product C2.";
    }

    public function anotherUsefulFunctionC(Connection $collaborator): string
    {

        $result = $collaborator->usefulFunctionA();

        return "The result of the C2 collaborating with the ({$result})";
    }
}


function clientCode(DbFactory $factory)
{

    $dbConnection = $factory->createConnection();
    $dbRecrord = $factory->createRecrord();
    $dbQueryBuiler = $factory->createQueryBuiler();

    echo $dbRecrord->usefulFunctionB() . "\n";
    echo $dbRecrord->anotherUsefulFunctionB($dbConnection) . "\n";

    echo $dbQueryBuiler->usefulFunctionC() . "\n";
    echo $dbQueryBuiler->anotherUsefulFunctionC($dbConnection) . "\n";
}

echo "Client: Testing client code with the first factory type:\n";
clientCode(new MySQLFactory());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new PostgreSQLFactory());
clientCode(new OracleFactory());
