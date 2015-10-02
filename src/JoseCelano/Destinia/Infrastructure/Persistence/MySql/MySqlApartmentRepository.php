<?php

namespace JoseCelano\Destinia\Infrastructure\Persistence\MySql;

use Config;
use JoseCelano\Destinia\Domain\Apartment;
use JoseCelano\Destinia\Domain\ApartmentId;
use JoseCelano\Destinia\Domain\ApartmentRepository;
use JoseCelano\Destinia\Domain\SqlSpecification;
use mysqli;

/**
 * Class MySqlApartmentRepository
 * @package JoseCelano\Destinia\Infrastructure\Persistence\MySql
 */
class MySqlApartmentRepository implements ApartmentRepository
{
    /**
     * @var string
     */
    private $hostname;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var mysqli
     */
    private $conn;

    function __construct(Config $config)
    {
        $this->hostname = $config->getParameter('db_hostname');
        $this->database = $config->getParameter('db_database');
        $this->username = $config->getParameter('db_username');
        $this->password = $config->getParameter('db_password');
    }

    /**
     * @return ApartmentId
     */
    public function nextIdentity()
    {
        $id = strtoupper(str_replace('.', '', uniqid('', true)));
        return ApartmentId::create($id);
    }

    /**
     * @param ApartmentId $apartmentId
     * @return Apartment
     * @throws \Exception
     */
    public function apartmentOfId(ApartmentId $apartmentId)
    {
        // TODO
        throw new \Exception("apartmentOfId not implemented");
    }

    /**
     * @param Apartment $apartment
     * @throws \Exception
     */
    public function insert(Apartment $apartment)
    {
        $this->connect();

        $id = mysqli_real_escape_string($this->conn, $apartment->getId()->getValue());
        $name = mysqli_real_escape_string($this->conn, $apartment->getName());
        $numFlats = mysqli_real_escape_string($this->conn, $apartment->getNumFlats());
        $numAdultsPerFlat = mysqli_real_escape_string($this->conn, $apartment->getNumAdultsPerFlat());

        $sql = sprintf("INSERT INTO `apartment` (`id`, `name`, `num_flats`, `num_adults_per_flat`) VALUES ('%s', '%s', %d, '%s')", $id, $name, $numFlats, $numAdultsPerFlat);

        if (!mysqli_query($this->conn, $sql)) {
            throw new \Exception("Error: " . $sql . "SQL Error" . mysqli_error($this->conn));
        }

        $this->closeConnection();
    }

    /**
     * @param Apartment $apartment
     * @throws \Exception
     */
    public function update(Apartment $apartment)
    {
        // TODO
        throw new \Exception("update not implemented");
    }

    /**
     * @param Apartment $apartment
     * @throws \Exception
     */
    public function delete(Apartment $apartment)
    {
        // TODO
        throw new \Exception("delete not implemented");
    }

    /**
     * @param SqlSpecification $specification
     * @return \JoseCelano\Destinia\Domain\Hotel[]
     * @throws \Exception
     */
    public function query($specification)
    {
        $this->connect();

        $clauses = $specification->toSqlClauses();
        $sql = sprintf("SELECT * FROM `apartment` WHERE %s;", $clauses);

        $result = mysqli_query($this->conn, $sql);

        $apartments = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $apartment = new Apartment(new ApartmentId($row["id"]), $row["name"], $row["num_flats"], $row["num_adults_per_flat"]);
                $apartments[] = $apartment;
            }
        }

        $this->closeConnection();

        return $apartments;
    }

    /**
     * @return \JoseCelano\Destinia\Domain\Apartment[]
     * @throws \Exception
     */
    public function findAll()
    {
        // TODO
        throw new \Exception("findAll not implemented");
    }

    private function connect()
    {
        // Create connection
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    private function closeConnection()
    {
        mysqli_close($this->conn);
    }
}