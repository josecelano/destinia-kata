<?php

namespace JoseCelano\Destinia\Infrastructure\Persistence\MySql;

use Config;
use JoseCelano\Destinia\Domain\Hotel;
use JoseCelano\Destinia\Domain\HotelId;
use JoseCelano\Destinia\Domain\HotelRepository;
use JoseCelano\Destinia\Domain\SqlSpecification;
use mysqli;

/**
 * Class MySqlHotelRepository
 * @package JoseCelano\Destinia\Infrastructure\Persistence\MySql
 */
class MySqlHotelRepository implements HotelRepository
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
     * @return HotelId
     */
    public function nextIdentity()
    {
        $id = strtoupper(str_replace('.', '', uniqid('', true)));
        return HotelId::create($id);
    }

    /**
     * @param HotelId $hotelId
     * @return Hotel
     * @throws \Exception
     */
    public function hotelOfId(HotelId $hotelId)
    {
        // TODO
        throw new \Exception("hotelOfId not implemented");
    }

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function insert(Hotel $hotel)
    {
        $this->connect();

        $id = mysqli_real_escape_string($this->conn, $hotel->getId()->getValue());
        $name = mysqli_real_escape_string($this->conn, $hotel->getName());
        $starts = mysqli_real_escape_string($this->conn, $hotel->getStarts());
        $standardRoomType = mysqli_real_escape_string($this->conn, $hotel->getStandardRoomType());

        $sql = sprintf("INSERT INTO `hotel` (`id`, `name`, `starts`, `standard_room_type`) VALUES ('%s', '%s', %d, '%s')", $id, $name, $starts, $standardRoomType);

        if (!mysqli_query($this->conn, $sql)) {
            throw new \Exception("Error: " . $sql . "SQL Error" . mysqli_error($this->conn));
        }

        $this->closeConnection();
    }

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function update(Hotel $hotel)
    {
        // TODO
        throw new \Exception("update not implemented");
    }

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function delete(Hotel $hotel)
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

        $sql = sprintf("SELECT * FROM `hotel` WHERE %s;", $clauses);

        $result = mysqli_query($this->conn, $sql);

        $hotels = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $hotel = new Hotel(new HotelId($row["id"]), $row["name"], $row["starts"], $row["standard_room_type"]);
                $hotels[] = $hotel;
            }
        }

        $this->closeConnection();

        return $hotels;
    }

    /**
     * @return Hotel[]
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