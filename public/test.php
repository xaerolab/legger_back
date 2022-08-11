<?php


/*
use App\Models\DB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

//nueva instancia de AppFactory
$app = AppFactory::create();

//support sending of data in a JSON in a post request
$app->addBodyParsingMiddleware();

/*
//creamos el middleware
$app->addRoutingMiddleware();
$app->add(new BasePathMiddleware($app));
$app->addErrorMiddleware(true, true, true);


/*
//http get request
$app->get('/lead/all', function (Request $request, Response $response) {
 $sql = "SELECT * FROM registros";

 try {
   $db = new Db();
   $conn = $db->connect();
   $stmt = $conn->query($sql);
   $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
   $db = null;
  
   $response->getBody()->write(json_encode($customers));
   return $response
     ->withHeader('content-type', 'application/json')
     ->withStatus(200);
 } catch (PDOException $e) {
   $error = array(
     "message" => $e->getMessage()
   );

   $response->getBody()->write(json_encode($error));
   return $response
     ->withHeader('content-type', 'application/json')
     ->withStatus(500);
 }
});


//http post request
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->post('/lead/add', function (Request $request, Response $response, array $args) {
 $data = $request->getParsedBody();
 
 $nombre = $data["nombre"];
 $nit = $data["nit"];
 $punto = $data["punto"];
 $equipo = $data["equipo"];
 $ciudad = $data["ciudad"];
 $promotor = $data["promotor"];
 $rtc = $data["rtc"];
 $capitan = $data["capitan"];
 
 //$dir_ip = $data["dir_ip"];
 $dir_ip = "0.0.0.0";

 $terminos = $data["terminos"];
        

 $sql = "INSERT INTO registros (nombre, nit, punto, equipo, ciudad, promotor, rtc, capitan, dir_ip, terminos) VALUES (:nombre, :nit, :punto, :equipo, :ciudad, :promotor, :rtc, :capitan, :dir_ip, :terminos)";

 try {
   $db = new Db();
   $conn = $db->connect();
  
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':nombre', $nombre);
   $stmt->bindParam(':nit', $nit);
   $stmt->bindParam(':punto', $punto);

   $stmt->bindParam(':equipo', $equipo);
   $stmt->bindParam(':ciudad', $ciudad);
   $stmt->bindParam(':promotor', $promotor);
   $stmt->bindParam(':rtc', $rtc);
   $stmt->bindParam(':capitan', $capitan);
   $stmt->bindParam(':dir_ip', $dir_ip);
   $stmt->bindParam(':terminos', $terminos);

   $result = $stmt->execute();

   $db = null;
   $response->getBody()->write(json_encode($result));
   return $response
     ->withHeader('content-type', 'application/json')
     ->withStatus(200);
 } catch (PDOException $e) {
   $error = array(
     "message" => $e->getMessage()
   );

   $response->getBody()->write(json_encode($error));
   return $response
     ->withHeader('content-type', 'application/json')
     ->withStatus(500);
 }
});

//ejecutamos el app
$app->run();*/