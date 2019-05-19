
<div id="appBuscarCliente"> 
    <!-- 
        ==============================
        Todos os compontentes da busca 
        ==============================
        -->
    <div class="container">
        <div class="row mt-4">
                <div class="col">
                    <div class="input-group mb-3">
                        <input v-on:input="getCliente()" v-model="txtBusca" type="text" class="form-control" placeholder="Nome do cliente" aria-label="Nome do cliente" aria-describedby="button-addon">
                        <div class="input-group-append">
                            <button v-on:click.stop.prevent="getCliente()" class="btn btn-outline-secondary" type="button" id="button-addon">Buscar</button>
                        </div>
                    </div>
                </div>
        </div>
        <div v-for="erro in erros" class="row mt-4">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erros:</strong>
                    {{erro}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <transition-group name="list" class="col" tag="div">
                <div v-for="cliente in clientes" v-bind:key="cliente.id" class="card mt-4">
                    <div class="card-header">
                        {{cliente.nome}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados do cliente:</h5>
                        <p class="card-text">
                            <strong>CPF:</strong>
                            {{cliente.cpf}}
                        </p>
                        <p class="card-text">
                            <strong>Celular:</strong>
                            {{cliente.celular}}
                        </p>
                        
                        <p class="card-text">
                            <strong>Logradouro:</strong>
                            {{cliente.logradouro}}
                        </p>
                        <p class="card-text">
                            <strong>Bairro:</strong>
                            {{cliente.bairro}}
                        </p>
                        <p class="card-text">
                            <strong>Cidade:</strong>
                            {{cliente.cidade}}
                        </p>
                        <p class="card-text">
                            <strong>Estado:</strong>
                            {{cliente.estado}}
                        </p>
                        <p class="card-text">
                            <strong>E-mail:</strong>
                            {{cliente.email}}
                        </p>

                        <a v-on:click="idExclusao=cliente.id" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger text-white">Excluir</a>
                        <a v-on:click="alterarCliente(cliente)" class="btn btn-primary  text-white" data-toggle="modal" data-target="#modalAlterar">Alterar</a>
                    </div>
                </div>  
            </transition-group>
        </div>
    </div>
    <!-- 
        ===================================================
                FIM DE Todos os compontentes da busca 
        ===================================================
        -->
        <!-- 
            =========================
            Modal confirmar exclusão
            =========================
        -->
        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Atenção! Essa exclusão não poderá ser revertida.
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="idExclusao=''" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button v-on:click="deleteCliente(idExclusao)" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        ==============================
         Fim Modal confirmar exclusão
        ==============================
        -->

        <!-- 
            =========================
            Modal Alterar Cliente
            =========================
        -->
        <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- INPUT NOME-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome</span>
                            </div>
                                <input v-model="clienteAlterar.nome" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT CPF-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">CPF</span>
                            </div>
                                <input v-model="clienteAlterar.cpf" type="text" class="form-control" id="idtxtcpf" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Celular-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">Celular</span>
                            </div>
                                <input v-model="clienteAlterar.celular" type="text" class="form-control" id="idtxtcelular" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT logradouro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbllogradouro">Logradouro</span>
                            </div>
                                <input v-model="clienteAlterar.logradouro" type="text" class="form-control" id="idtxtlogradouro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Bairro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblbairro">Bairro</span>
                            </div>
                                <input v-model="clienteAlterar.bairro" type="text" class="form-control" id="idtxtbairro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT cidade-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcidade">Cidade</span>
                            </div>
                                <input v-model="clienteAlterar.cidade" type="text" class="form-control" id="idtxtcidade" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT estado-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblestado">Estado</span>
                            </div>
                                <input v-model="clienteAlterar.estado" type="text" class="form-control" id="idtxtestado" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblemail">Email</span>
                            </div>
                                <input v-model="clienteAlterar.email" type="text" class="form-control" id="idtxtemail" aria-describedby="basic-addon3">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="descartarAlteracoesCliente()" type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                        <button v-on:click="salvarAlteracaoCliente()" type="button" class="btn btn-success" data-dismiss="modal">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        ==============================
         Fim Modal Alterar Cliente
        ==============================
        -->
</div>
<!-- Codificação do Vue.js -->
<!--
    Liberar porta do servidor:
    sudo iptables -A INPUT -p tcp --dport 8089 -j ACCEPT
-->
<script>
    var mixin = {
        methods: {
            getCliente(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/cliente/buscarnome/' + this.txtBusca;
                if(this.txtBusca!=''){
                    axios.get(url).then(function(r){
                        vm.clientes =[];
                        vm.clientes = r.data.data;
                        vm.erros = [];
                    }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.clientes = [];
                        console.log(error.response.data.errors);
                    }).finally(function () {
                        
                    });
                }else{
                    vm.clientes=[];
                }
            },
            deleteClientes(id){
                console.log("Id do cliente a deletar: " + id);
                var vm = this;
                var url = 'http://' + host + ':8089/api/cliente/remover/' + id;
                axios.delete(url).then(function(r){
                    vm.clientes = vm.deleteClientesVetorId(vm.clientes);
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.clientes = [];
                        
                }).finally(function () {
                    
                });
            },
            deleteClientesVetorId(arr){
                var vm = this;
                arr = arr.filter(function(obj) {
                    return obj.id !== vm.idExclusao;
                });
                return arr;
            },
            alterarCliente(f){
                this.clienteAlterar = f;
                this.clienteAlterarAux = f;
            },
            salvarAlteracaoCliente(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/cliente/atualizar/' + this.clienteAlterar.id;
                axios.put(url, this.clienteAlterar).then(function(r){
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.clientes = [];
                }).finally(function () {
                    
                });
            },
            descartarAlteracoesCliente(){
                this.clientes = [];
                this.getcliente();
            }
        }
    }
    var appBuscarCliente = new Vue({
        el: "#appBuscarCliente",
        mixins: [mixin],
        data: {
          txtBusca: "",
          clientes: [],
          erros:[],
          idExclusao: "",
          clienteAlterar: {},
        }
    });
</script>