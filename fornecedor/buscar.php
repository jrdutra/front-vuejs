
<div id="appBuscarFornecedor"> 
    <!-- 
        ==============================
        Todos os compontentes da busca 
        ==============================
        -->
    <div class="container">
        <div class="row mt-4">
                <div class="col">
                    <div class="input-group mb-3">
                        <input v-on:input="getFornecedor()" v-model="txtBusca" type="text" class="form-control" placeholder="Nome do fornecedor" aria-label="Nome do fornecedor" aria-describedby="button-addon">
                        <div class="input-group-append">
                            <button v-on:click.stop.prevent="getFornecedor()" class="btn btn-outline-secondary" type="button" id="button-addon">Buscar</button>
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
                <div v-for="fornecedor in fornecedores" v-bind:key="fornecedor.id" class="card mt-4">
                    <div class="card-header">
                        {{fornecedor.nome}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados do forncedor:</h5>
                        <p class="card-text">
                            <strong>CNPJ:</strong>
                            {{fornecedor.cnpj}}
                        </p>
                        <p class="card-text">
                            <strong>Telefone:</strong>
                            {{fornecedor.telefone}}
                        </p>
                        <p class="card-text">
                            <strong>Endereço:</strong>
                            {{fornecedor.endereco}}
                        </p>
                        <a v-on:click="idExclusao=fornecedor.id" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger text-white">Excluir</a>
                        <a v-on:click="alterarFornecedor(fornecedor)" class="btn btn-primary  text-white" data-toggle="modal" data-target="#modalAlterar">Alterar</a>
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
                        <button v-on:click="deleteFornecedor(idExclusao)" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
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
            Modal Alterar Fornecedor
            =========================
        -->
        <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar fornecedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Alterar Fornecedor!!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        ==============================
         Fim Modal Alterar fornecedor
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
            getFornecedor(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/fornecedor/buscarnome/' + this.txtBusca;
                if(this.txtBusca!=''){
                    axios.get(url).then(function(r){
                        vm.fornecedores =[];
                        vm.fornecedores = r.data.data;
                        vm.erros = [];
                    }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.fornecedores = [];
                        console.log(error.response.data.errors);
                    }).finally(function () {
                        
                    });
                }else{
                    vm.fornecedores=[];
                }
            },
            deleteFornecedor(id){
                console.log("Id do usuario a deletar: " + id);
                var vm = this;
                var url = 'http://' + host + ':8089/api/fornecedor/remover/' + id;
                axios.delete(url).then(function(r){
                    vm.fornecedores = vm.deleteFornecedorVetorId(vm.fornecedores);
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.fornecedores = [];
                        console.log(error.response.data.errors);
                }).finally(function () {
                    
                });
            },
            deleteFornecedorVetorId(arr){
                var vm = this;
                arr = arr.filter(function(obj) {
                    return obj.id !== vm.idExclusao;
                });
                return arr;
            },
            alterarFornecedor(f){
                console.log(f);
            }
        }
    }
    var appBuscarFornecedor = new Vue({
        el: "#appBuscarFornecedor",
        mixins: [mixin],
        data: {
          txtBusca: "",
          fornecedores: [],
          erros:[],
          idExclusao: "",
          fornecedorAlterar: "",
        }
    });
</script>