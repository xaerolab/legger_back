<?php

//funcionalidades que utilizaremos del framework
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

use App\Models\DB;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

//cargamos autoload
require_once __DIR__ . '/../vendor/autoload.php';

//creamos una nueva instancia
$app = AppFactory::create();

//se encargara de castear el formato Json para el metodo POST
$app->addBodyParsingMiddleware();

//Utilizamos este Middleware para permitir Access-Control con los metodos
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    $routeContext = RouteContext::fromRequest($request);
    $routingResults = $routeContext->getRoutingResults();
    $methods = $routingResults->getAllowedMethods();
    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $handler->handle($request);

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', implode(',', $methods));
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    // Optional: Allow Ajax CORS requests with Authorization header
    $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});

// The RoutingMiddleware should be added after our CORS middleware so routing is performed first
$app->addRoutingMiddleware();

//Solicitudes HTTP GET / POST

//GET
$app->get('/lead/all', function (Request $request, Response $response): Response {
    
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

//POST add lead
$app->post('/lead/add', function (Request $request, Response $response): Response {
      $data = $request->getParsedBody();
 
       $nombre = $data["nombre"];
       $nit = $data["nit"];
       $punto = $data["punto"];
       $equipo = $data["equipo"];
       $ciudad = $data["ciudad"];
       $promotor = $data["promotor"];
       $rtc = $data["rtc"];
       $capitan = $data["capitan"];
       
       //consultamos la direccion ip
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
           {
             $dir_ip = $_SERVER['HTTP_CLIENT_IP'];
           }
         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
           {
             $dir_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
           }
         else
           {
             $dir_ip = $_SERVER['REMOTE_ADDR'];
           }
      
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


// Allow preflight requests
// Due to the behaviour of browsers when sending a request,
// you must add the OPTIONS method. Read about preflight.
$app->options('/lead/add', function (Request $request, Response $response): Response {
    // Do nothing here. Just return the response.
    return $response;
});

//POST login
$app->post('/login', function (Request $request, Response $response): Response{
   $data = $request->getParsedBody();

   $usuario = $data["usuario"];
   $clave = hash('sha512', $data["clave"]);

   $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

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

$app->run();