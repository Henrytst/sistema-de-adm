<?php

class Funcionarios
{
    private $id, $arquivo, $nome_arquivo, $name, $rg, $cpf, $email, $cb, $phone, $manequim, $calcado,
        $altura, $status, $hierarquia, $idiomas, $created_at, $update_at;

    public $conectar;

    public function __construct()
    {
        try {
            $this->conectar = new PDO("mysql:host=localhost;dbname=SHAKERS", "root", "");
            $this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            header('location: ./migrations/index.php');
        }
    }
    public function adicionarCliente(
        $arquivo,
        $nome_arquivo,
        $name,
        $rg,
        $cpf,
        $email,
        $cb,
        $phone,
        $manequim,
        $calcado,
        $altura,
        $status,
        $hierarquia,
        $idiomas,
        $created_at
    ) {
        $this->dadosCadastrar(
            $arquivo,
            $nome_arquivo,
            $name,
            $rg,
            $cpf,
            $email,
            $cb,
            $phone,
            $manequim,
            $calcado,
            $altura,
            $status,
            $hierarquia,
            $idiomas,
            $created_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'INSERT INTO funcionarios (arquivo, nome_arquivo, name, rg, cpf, email, cb, phone, manequim, calcado,
                altura, status, hierarquia, idiomas, created_at) 
                VALUES (:ARQUIVO, :NOME_ARQUIVO, :NOME, :RG, :CPF, :EMAIL, :CB, :TELEFONE, :MANEQUIM, :CALCADO, :ALTURA,
                :STATUS, :HIERARQUIA, :IDIOMAS, :CRIADO_POR)'
            );
            $stmt->execute(
                array(
                    ":ARQUIVO" => $this->getarquivo(),
                    ":NOME_ARQUIVO" => $this->getnome_arquivo(),
                    ":NOME" => $this->getname(),
                    ":RG" => $this->getrg(),
                    ":CPF" => $this->getcpf(),
                    ":EMAIL" => $this->getemail(),
                    ":CB" => $this->getcb(),
                    ":TELEFONE" => $this->getphone(),
                    ":MANEQUIM" => $this->getmanequim(),
                    ":CALCADO" => $this->getcalcado(),
                    ":ALTURA" => $this->getaltura(),
                    ":STATUS" => $this->getstatus(),
                    ":HIERARQUIA" => $this->gethierarquia(),
                    ":IDIOMAS" => $this->getidiomas(),
                    ":CRIADO_POR" => $this->getcreated_at()
                )
            );
            $stmt->rowCount();
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function dadosCadastrar(
        $arquivo,
        $nome_arquivo,
        $name,
        $rg,
        $cpf,
        $email,
        $cb,
        $phone,
        $manequim,
        $calcado,
        $altura,
        $status,
        $hierarquia,
        $idiomas,
        $created_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome_arquivo($nome_arquivo);
        $this->setname($name);
        $this->setrg($rg);
        $this->setcpf($cpf);
        $this->setemail($email);
        $this->setcb($cb);
        $this->setphone($phone);
        $this->setmanequim($manequim);
        $this->setcalcado($calcado);
        $this->setaltura($altura);
        $this->setstatus($status);
        $this->sethierarquia($hierarquia);
        $this->setidiomas($idiomas);
        $this->setcreated_at($created_at);
    }

    public function dadosEditar(
        $arquivo,
        $nome_arquivo,
        $name,
        $rg,
        $cpf,
        $email,
        $cb,
        $phone,
        $manequim,
        $calcado,
        $altura,
        $status,
        $hierarquia,
        $idiomas,
        $update_at
    ) {
        $this->setarquivo($arquivo);
        $this->setnome_arquivo($nome_arquivo);
        $this->setname($name);
        $this->setrg($rg);
        $this->setcpf($cpf);
        $this->setemail($email);
        $this->setcb($cb);
        $this->setphone($phone);
        $this->setmanequim($manequim);
        $this->setcalcado($calcado);
        $this->setaltura($altura);
        $this->setstatus($status);
        $this->sethierarquia($hierarquia);
        $this->setidiomas($idiomas);
        $this->setupdate_at($update_at);
    }
    public function editarCliente(
        $id,
        $arquivo,
        $nome_arquivo,
        $name,
        $rg,
        $cpf,
        $email,
        $cb,
        $phone,
        $manequim,
        $calcado,
        $altura,
        $status,
        $hierarquia,
        $idiomas,
        $update_at
    ) {
        $this->setid($id);
        $this->dadosEditar(
            $arquivo,
            $nome_arquivo,
            $name,
            $rg,
            $cpf,
            $email,
            $cb,
            $phone,
            $manequim,
            $calcado,
            $altura,
            $status,
            $hierarquia,
            $idiomas,
            $update_at
        );
        try {
            $stmt = $this->conectar->prepare(
                'UPDATE funcionarios SET arquivo=:ARQUIVO, nome_arquivo=:NOME_ARQUIVO, name=:NOME, rg=:RG, cpf=:CPF, email=:EMAIL, cb=:CB, phone=:TELEFONE, manequim=:MANEQUIM, 
                calcado=:CALCADO, altura=:ALTURA, status=:STATUS, hierarquia=:HIERARQUIA, idiomas=:IDIOMAS, update_at=:ALTERADO_POR WHERE id=:ID'
            );
            $stmt->execute(array(
                ":ID" => $this->id,
                ":ARQUIVO" => $this->getarquivo(),
                ":NOME_ARQUIVO" => $this->getnome_arquivo(),
                ":NOME" => $this->getname(),
                ":RG" => $this->getrg(),
                ":CPF" => $this->getcpf(),
                ":EMAIL" => $this->getemail(),
                ":CB" => $this->getcb(),
                ":TELEFONE" => $this->getphone(),
                ":MANEQUIM" => $this->getmanequim(),
                ":CALCADO" => $this->getcalcado(),
                ":ALTURA" => $this->getaltura(),
                ":STATUS" => $this->getstatus(),
                ":HIERARQUIA" => $this->gethierarquia(),
                ":IDIOMAS" => $this->getidiomas(),
                ":ALTERADO_POR" => $this->getupdate_at()
            ));
            return 1;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function excluirCliente($id)
    {
        $this->setid($id);
        try {
            $stmt = $this->conectar->prepare('DELETE FROM funcionarios where id = :ID');
            $stmt->execute(array(":ID" => $this->id));
            $retorno = $stmt->rowCount();
            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function listarTodosClientes()
    {
        $stmt = $this->conectar->prepare('SELECT * FROM funcionarios ORDER BY name ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }
    public function carregarCliente($id)
    {
        $this->setid($id);
        $stmt = $this->conectar->prepare('SELECT * FROM funcionarios where id = :ID ORDER BY name ASC');
        $stmt->execute(array(":ID" => $this->id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    private function setId($id)
    {
        $this->id = $id;
    }
    private function setarquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }
    private function setnome_arquivo($nome_arquivo)
    {
        $this->nome_arquivo = $nome_arquivo;
    }
    private function setname($name)
    {
        $this->name = $name;
    }
    private function setrg($rg)
    {
        $this->rg = $rg;
    }
    private function setcpf($cpf)
    {
        $this->cpf = $cpf;
    }
    private function setemail($email)
    {
        $this->email = $email;
    }
    private function setcb($cb)
    {
        $this->cb = $cb;
    }
    private function setmanequim($manequim)
    {
        $this->manequim = $manequim;
    }
    private function setcalcado($calcado)
    {
        $this->calcado = $calcado;
    }
    private function setaltura($altura)
    {
        $this->altura = $altura;
    }
    private function setphone($phone)
    {
        $this->phone = $phone;
    }
    private function setstatus($status)
    {
        $this->status = $status;
    }
    private function sethierarquia($hierarquia)
    {
        $this->hierarquia = $hierarquia;
    }
    private function setidiomas($idiomas)
    {
        $this->idiomas = $idiomas;
    }
    private function setcreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    private function setupdate_at($update_at)
    {
        $this->update_at = $update_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getarquivo()
    {
        return $this->arquivo;
    }
    public function getnome_arquivo()
    {
        return $this->nome_arquivo;
    }
    public function getname()
    {
        return $this->name;
    }
    public function getrg()
    {
        return $this->rg;
    }
    public function getcpf()
    {
        return $this->cpf;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getcb()
    {
        return $this->cb;
    }
    public function getmanequim()
    {
        return $this->manequim;
    }
    public function getcalcado()
    {
        return $this->calcado;
    }
    public function getaltura()
    {
        return $this->altura;
    }
    public function getphone()
    {
        return $this->phone;
    }
    public function getstatus()
    {
        return $this->status;
    }
    public function gethierarquia()
    {
        return $this->hierarquia;
    }
    public function getidiomas()
    {
        return $this->idiomas;
    }
    public function getcreated_at()
    {
        return $this->created_at;
    }
    public function getupdate_at()
    {
        return $this->update_at;
    }
}
