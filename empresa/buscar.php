<div id="appBuscarEmpresa"> 
    <!-- 
        ==============================
        Todos os compontentes da busca 
        ==============================
        -->
    <div class="container">
        <div class="row mt-4">
                <div class="col">
                    <div class="input-group mb-3">
                        <input v-on:input="getEmpresa()" v-model="txtBusca" type="text" class="form-control" placeholder="Nome da empresa" aria-label="Nome da empresa" aria-describedby="button-addon">
                        <div class="input-group-append">
                            <button v-on:click.stop.prevent="getEmpresa()" class="btn btn-outline-secondary" type="button" id="button-addon">Buscar</button>
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
                <div v-for="empresa in empresas" v-bind:key="empresa.id" class="card mt-4">
                    <div class="card-header">
                        {{empresa.nomeFantasia}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados da empresa:</h5>
                        <p class="card-text">
                            <strong>Razao Social:</strong>
                            {{empresa.razaoSocial}}
                        </p>
                        <p class="card-text">
                            <strong>CNPJ:</strong>
                            {{empresa.cnpj}}
                        </p>
                        <p class="card-text">
                            <strong>Logradouro:</strong>
                            {{empresa.logradouro}}
                        </p>
                        <p class="card-text">
                            <strong>Bairro:</strong>
                            {{empresa.bairro}}
                        </p>
                        <p class="card-text">
                            <strong>Cidade:</strong>
                            {{empresa.cidade}}
                        </p>
                        <p class="card-text">
                            <strong>Estado:</strong>
                            {{empresa.estado}}
                        </p>
                        <p class="card-text">
                            <strong>E-mail:</strong>
                            {{empresa.email}}
                        </p>
                        <p class="card-text">
                            <!-- Empregados -->
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h4 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <strong>Empregados:</strong>
                                            </button>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <ul class="list-group list-group-flush" v-for="empregado in empresa.empregados">
                                            <li class="list-group-item">{{empregado.nome}} - {{empregado.funcao}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                </div>
                            </div>

                        </p>
                        <a v-on:click="idExclusao=empresa.id" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger text-white">Excluir</a>
                        <a v-on:click="alterarEmpresa(empresa)" class="btn btn-primary  text-white" data-toggle="modal" data-target="#modalAlterar">Alterar</a>
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
                        <button v-on:click="deleteEmpresa(idExclusao)" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
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
            Modal Alterar Empresa
            =========================
        -->
        <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- INPUT Nome Fantasia-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome Fantasia</span>
                            </div>
                                <input v-model="empresaAlterar.nomeFantasia" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>
                         <!-- INPUT Razao Social-->
                         <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblrazaosocial">Razao Social</span>
                            </div>
                                <input v-model="empresaAlterar.razaoSocial" type="text" class="form-control" id="idtxtrazaosocial" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT CNPJ-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcnpj">CNPJ</span>
                            </div>
                                <input v-model="empresaAlterar.cnpj" type="text" class="form-control" id="idtxtcnpj" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT logradouro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbllogradouro">Logradouro</span>
                            </div>
                                <input v-model="empresaAlterar.logradouro" type="text" class="form-control" id="idtxtlogradouro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Bairro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblbairro">Bairro</span>
                            </div>
                                <input v-model="empresaAlterar.bairro" type="text" class="form-control" id="idtxtbairro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT cidade-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcidade">Cidade</span>
                            </div>
                                <input v-model="empresaAlterar.cidade" type="text" class="form-control" id="idtxtcidade" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT estado-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblestado">Estado</span>
                            </div>
                                <input v-model="empresaAlterar.estado" type="text" class="form-control" id="idtxtestado" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblemail">Email</span>
                            </div>
                                <input v-model="empresaAlterar.email" type="text" class="form-control" id="idtxtemail" aria-describedby="basic-addon3">
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="descartarAlteracoesEmpresa()" type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                        <button v-on:click="salvarAlteracaoEmpresa()" type="button" class="btn btn-success" data-dismiss="modal">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        ==============================
         Fim Modal Alterar empresa
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
            getEmpresa(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empresa/buscarnomefantasia/' + this.txtBusca;
                if(this.txtBusca!=''){
                    axios.get(url).then(function(r){
                        vm.empresas =[];
                        vm.empresas = r.data.data;
                        vm.erros = [];
                    }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empresas = [];
                        console.log(error.response.data.errors);
                    }).finally(function () {
                        
                    });
                }else{
                    vm.empresas=[];
                }
            },
            deleteEmpresa(id){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empresa/remover/' + id;
                axios.delete(url).then(function(r){
                    vm.empresas = vm.deleteEmpresaVetorId(vm.empresas);
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empresas = [];
                        
                }).finally(function () {
                    
                });
            },
            deleteEmpresaVetorId(arr){
                var vm = this;
                arr = arr.filter(function(obj) {
                    return obj.id !== vm.idExclusao;
                });
                return arr;
            },
            alterarEmpresa(f){
                this.empresaAlterar = f;
                this.empresaAlterarAux = f;
            },
            salvarAlteracaoEmpresa(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empresa/atualizar/' + this.empresaAlterar.id;
                axios.put(url, this.empresaAlterar).then(function(r){
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empresas = [];
                }).finally(function () {
                    
                });
            },
            descartarAlteracoesEmpresa(){
                this.empresas = [];
                this.getEmpresa();
            }
        }
    }
    var appBuscarEmpresa = new Vue({
        el: "#appBuscarEmpresa",
        mixins: [mixin],
        data: {
          txtBusca: "",
          empresas: [],
          erros:[],
          idExclusao: "",
          empresaAlterar: {},
        }
    });
</script>