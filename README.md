# wuuPHP
## Core API
### Router
Modulo de sistema de rotas que consiste configurar um caminho para uma função ou uma classe e um método estático.
###### Exemplo
  	Router::get('/', function(){ echo "Hello Wuu!"; });
###### Passando função como parametro
	Router::get('/', "home");
    
    function home(){
    	echo "Hello Wuu!";
    }
###### Passando classe como parametro
	Router::get('/', ['www','home']);
    
    class www{
    	function home(){
    		echo "Hello Wuu!";
    	}
    }
#### Metodos de roteamento
	Router::get($path, $fn);
    Router::post($path, $fn);
### Redirecionar
	Router::redirect($path,$code="301");