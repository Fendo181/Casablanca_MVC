<?php


class DbManager{

protected $connections = array();

public function connect($name,$params){
    $params = array_merge(array(
        'dsn' => null,
        'user' => '',
        'password' => '',
        'options' => array(),
    ),$params);

    $con = new PDO(
        $params['dsn'],
        $params['user'],
        $params['password'],
        $params['options']
    );

    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $this->connections[$name] =$con;
}

    public function getConnection($name = null)
    {
        if(is_null($name)){
            return current($this->connections);
        }

            return $this->connections[$name];
    }

    /*##
    #Repositoryメソッドの追加
    */##
    protected $repository_connections_map = array();


    public function setRepositoryConnectionMap($repository_name,$name)
    {
        if(isset($this->repository_connection_map[$repository_name])){
            $name = $this->repository;
            $con = $this->getConnection($name);
        }else{
            $con =$this->getConnection();
        }

        return $con;
    }

     /*##
    #Repositoryクラスの管理
    */##

    public function getConnectionForRepository($repository_name){

        if(!isset($this->repositories[$repository_name])){
            $repository_class = $repository_name.'Repository';
            $con = $this->getConnectionForRepository($repository_name);

            $repository = new $repository;

            $this->repositories[$repository_name] = $repository;
        }

        return $this->reposotories[$repository_name];

    }

    public function __dstruct()
    {
        foreach ($this -> repositories as $repository){
            unset($repository);
        }


        foreach($this ->connections as $con){
            unset($con);
        }
    }



}
