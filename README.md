# legionlab/restapi
Rest API PHP for apps mobiles
_______________________________

Install command:

    composer create-project legionlab/restapi your-project
_______________________________

Configure your ambient, in file setups.php:

    Settings::set('api_url', 'url_from_project');

    Settings::set("dbhost", "url_db");

    Settings::set("dbuser", "user_db");

    Settings::set("dbpassword", "password_db");

    Settings::set("default_dbname", "name_db");
_______________________________
## Examples

### GET

    $app = new \LegionLab\Rest\Core();

    $app->get('/get', function () {
        echo 'Welcome to Rest API, by GET';
    });

    $app->get('/get', function ($data) {
        echo 'Welcome to Rest API, '.$data['name'].', by GET';
    }, [ 'name' => 'any' ]);

### POST

    $app = new \LegionLab\Rest\Core();
    
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['name'] = 'user';
    $_POST['age'] = 20;

    $app->post('/post', function () {
        echo 'Welcome to Rest API, by POST';
    });

    $app->post('/post', function ($data) {
        try {

            (new Client())->fill($data)->insert();
            echo 'Welcome to Rest API, by POST, client saved';
    
        } catch (Exception $e) {
            echo $e->getMessage().'<br>';
        }
    }, [ 'name' => 'any', 'age' => 'int' ]);

### PUT

    $app = new \LegionLab\Rest\Core();
    
    $app->put('/put', function($data) {
        try {
            $client = new Client();
            $client->fill($data);
            $client->get();
            $client->fill($data);
            $client->update();
            echo json_encode(['message' => 'The user '.$data['id'].' edited, by DELETE' ]);

        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage().'<br>' ]);
        }

    }, [ 'id' => 'int', 'age' => 'int']);

### DELETE

    $app = new \LegionLab\Rest\Core();
    
    $app->delete('/delete', function($data) {
        try {
            $criteria = \LegionLab\Utils\CriteriaBuilder::create()
                ->tables('clients')->_and('id', '=', $data['id']);

            (new Client())->delete($criteria);
            echo json_encode(['message' => 'The user '.$data['id'].' deleted, by DELETE' ]);

        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage().'<br>' ]);
        }
    }, [ 'id' => 'int' ]);

________________________________

### Simulate PUT and DELETE with cURL

### PUT

    $app = new \LegionLab\Rest\Core();
    
    $app->get('/sendput', function() {
        $curl = curl_init(Settings::get('api_url') . "/put");
    
        $data = array(
            'id' => 2,
            'age' => 90
        );
    
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        if (!$response)
            die("Connection Failure.n");
        else
            var_dump(json_decode($response));
    });
    
### DELETE

    $app = new \LegionLab\Rest\Core();
    
    $app->get('/senddelete', function() {
        $curl = curl_init(Settings::get('api_url') . "/delete");
    
        $data = array(
            'id' => '2'
        );
    
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        if (!$response)
            die("Connection Failure.n");
        else
            var_dump(json_decode($response));
    });

