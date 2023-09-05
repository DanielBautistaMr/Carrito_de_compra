<?php

class CreateDb
{
    // Declaración de variables públicas para la información de la base de datos
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    // Constructor de la clase que toma valores predeterminados para la base de datos
    public function __construct(
        $dbname = "Newdb",
        $tablename = "Productdb",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
        // Asigna los valores proporcionados a las variables de la instancia
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // Crea una conexión a la base de datos utilizando mysqli
        $this->con = mysqli_connect($servername, $username, $password);

        // Verifica si la conexión fue exitosa
        if (!$this->con){
            // Si no se pudo conectar, muestra un mensaje de error y termina el script
            die("Connection failed : " . mysqli_connect_error());
        }

        // Crea una consulta SQL para crear la base de datos si no existe
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // Ejecuta la consulta SQL
        if(mysqli_query($this->con, $sql)){

            // Si la base de datos se creó correctamente, cambia la conexión a esa base de datos
            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // Crea una consulta SQL para crear una tabla si no existe
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                        (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         product_name VARCHAR (25) NOT NULL,
                         product_price FLOAT,
                         product_image VARCHAR (100),
                         product_description VARCHAR (100) NOT NULL
                        );";

            // Ejecuta la consulta SQL para crear la tabla
            if (!mysqli_query($this->con, $sql)){
                // Si hubo un error al crear la tabla, muestra un mensaje de error
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            // Si no se pudo crear la base de datos, devuelve falso
            return false;
        }
    }

    // Función para obtener datos de la base de datos
    public function getData(){
        // Crea una consulta SQL para seleccionar todos los registros de la tabla
        $sql = "SELECT * FROM $this->tablename";

        // Ejecuta la consulta SQL
        $result = mysqli_query($this->con, $sql);

        // Verifica si se obtuvieron filas de datos
        if(mysqli_num_rows($result) > 0){
            // Devuelve el resultado (que contiene los datos)
            return $result;
        }
    }
}

?>