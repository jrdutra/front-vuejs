
<div id="appBuscarEmpregado"> 
    <!-- 
        ==============================
        Todos os compontentes da busca 
        ==============================
        -->
    <div class="container">
        <div class="row mt-4">
                <div class="col">
                    <div class="input-group mb-3">
                        <input v-on:input="getEmpregado()" v-model="txtBusca" type="text" class="form-control" placeholder="Nome do empregado" aria-label="Nome do empregado" aria-describedby="button-addon">
                        <div class="input-group-append">
                            <button v-on:click.stop.prevent="getEmpregado()" class="btn btn-outline-secondary" type="button" id="button-addon">Buscar</button>
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
        <div v-for="s in sucessos" class="row mt-4">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sucesso:</strong>
                    {{s}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <transition-group name="list" class="col" tag="div">
                <div v-for="empregado in empregados" v-bind:key="empregado.id" class="card mt-4">
                    <div class="card-header">
                        {{empregado.nome}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Dados do empregado:</h5>
                        <p class="card-text">
                            <strong>Nome:</strong>
                            {{empregado.nome}}
                        </p>
                        <p class="card-text">
                            <strong>CPF:</strong>
                            {{empregado.cpf}}
                        </p>
                        <p class="card-text">
                            <strong>Telefone:</strong>
                            {{empregado.telefone}}
                        </p>
                        <p class="card-text">
                            <strong>Funcao:</strong>
                            {{empregado.funcao}}
                        </p>
                        <p class="card-text">
                            <strong>Empresa:</strong>
                            {{empregado.empresaNomeFantasia}}
                        </p>

                        <a v-on:click="idExclusao=empregado.id" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger text-white">Excluir</a>
                        <a v-on:click="alterarEmpregado(empregado)" class="btn btn-primary  text-white" data-toggle="modal" data-target="#modalAlterar">Alterar</a>
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
                        <button v-on:click="deleteEmpregado(idExclusao)" type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
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
            Modal Alterar Empregado
            =========================
        -->
        <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar empregado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- INPUT Nome-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome</span>
                            </div>
                                <input v-model="empregadoAlterar.nome" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>
                         
                        <!-- INPUT CPF-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">CPF</span>
                            </div>
                                <input v-model="empregadoAlterar.cpf" type="text" class="form-control" id="idtxtcpf" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT telefone-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbltelefone">Telefone</span>
                            </div>
                                <input v-model="empregadoAlterar.telefone" type="text" class="form-control" id="idtxttelefone" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Funcao-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblfuncao">Função</span>
                            </div>
                                <input v-model="empregadoAlterar.funcao" type="text" class="form-control" id="idtxtfuncao" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Empresa-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblEmpresa">Empresa</span>
                                <span class="input-group-text">{{empresaSelecionada.nomeFantasia}}</span>
                            </div>
                            <input v-on:input="getEmpresa()" v-model="txtBuscaEmpresa" type="text" class="form-control" id="idtxtempresa" aria-describedby="basic-addon3">
                        </div>
                        <div class="input-group mb-3">
                            <div class="col">
                                <transition-group name="list" class="col" tag="div">
                                    <ul v-for="empresa in empresasBuscadas" v-bind:key="empresa.id" class="list-group mb-1">
                                        <li v-on:click="selecionaEmpresa(empresa)" class="list-group-item list-group-item-action ml-2">{{empresa.nomeFantasia}}</li>
                                    </ul>
                                </transition-group>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="descartarAlteracoesEmpregado()" type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                        <button v-on:click="salvarAlteracaoEmpregado()" type="button" class="btn btn-success" data-dismiss="modal">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        ==============================
         Fim Modal Alterar empregado
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
            getEmpregado(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empregado/buscarnome/' + this.txtBusca;
                if(this.txtBusca!=''){
                    axios.get(url).then(function(r){
                        vm.empregados =[];
                        vm.empregados = r.data.data;
                        vm.erros = [];
                        vm.sucessos = [];
                    }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empregados = [];
                        console.log(error.response.data.errors);
                    }).finally(function () {
                        
                    });
                }else{
                    vm.empregados=[];
                    vm.sucessos=[];
                }
            },
            deleteEmpregado(id){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empregado/remover/' + id;
                axios.delete(url).then(function(r){
                    vm.empregados = vm.deleteEmpregadoVetorId(vm.empregados);
                    vm.erros = [];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empregados = [];
                        
                }).finally(function () {
                    
                });
            },
            deleteEmpregadoVetorId(arr){
                var vm = this;
                arr = arr.filter(function(obj) {
                    return obj.id !== vm.idExclusao;
                });
                return arr;
            },
            alterarEmpregado(f){
                this.empregadoAlterar = f;
                this.empregadoAlterarAux = f;
                this.empresaSelecionada.id = f.empresaId;
                this.empresaSelecionada.nomeFantasia = f.empresaNomeFantasia;
            },
            salvarAlteracaoEmpregado(){
                var vm = this;
                var emp = {
                    id: this.empregadoAlterar.id,
                    nome: this.empregadoAlterar.nome,
                    cpf: this.empregadoAlterar.cpf,
                    telefone: this.empregadoAlterar.telefone,
                    funcao: this.empregadoAlterar.funcao,
                    empresa: {
                        id: this.empresaSelecionada.id
                    }
                };
                
                var url = 'http://' + host + ':8089/api/empregado/atualizar/' + emp.id;
                axios.put(url, emp).then(function(r){
                    vm.erros = [];
                    vm.empregados = [];
                    vm.sucessos = ["Empregado alterado com sucesso!"];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empregados = [];
                }).finally(function () {
                    
                });
            },
            descartarAlteracoesEmpregado(){
                this.empregados = [];
                this.getEmpregado();
                this.txtBuscaEmpresa = "";
                this.empresasBuscadas=[];
                this.sucessos=[];
            },
            getEmpresa(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empresa/buscarnomefantasia/' + this.txtBuscaEmpresa;
                if(this.txtBuscaEmpresa!=''){
                    axios.get(url).then(function(r){
                        vm.empresasBuscadas =[];
                        vm.empresasBuscadas = r.data.data;
                        vm.erros = [];
                    }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.empresasBuscadas = [];
                        console.log(error.response.data.errors);
                    }).finally(function () {
                        
                    });
                }else{
                    vm.empresasBuscadas=[];
                }
            },
            selecionaEmpresa(e){
                this.empresaSelecionada = e;
                this.txtBuscaEmpresa = "";
                this.empresasBuscadas=[];
                
            }
        }
    }
    var appBuscarEmpregado = new Vue({
        el: "#appBuscarEmpregado",
        mixins: [mixin],
        data: {
          txtBusca: "",
          empregados: [],
          erros:[],
          sucessos:[],
          idExclusao: "",
          empregadoAlterar: {
              id:"",
              nome: "",
              cpf: "",
              telefone: "",
              funcao: "",
              empresa:{id:""},
          },
          empresasBuscadas:[],
          txtBuscaEmpresa: "",
          empresaSelecionada: {},
        }
    });
</script>