<div id="appNovoEmpregado">
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Incluir novo empregado
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container">
                        <!-- INPUT nome-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome</span>
                            </div>
                                <input v-model="empregadoAIncluir.nome" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT CPF-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">Cpf</span>
                            </div>
                                <input v-model="empregadoAIncluir.cpf" type="text" class="form-control" id="idtxtCpf" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Telefone-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbltelefone">Telefone</span>
                            </div>
                                <input v-model="empregadoAIncluir.telefone" type="text" class="form-control" id="idtxtTelefone" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Funcao-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblFuncao">Funcao</span>
                            </div>
                                <input v-model="empregadoAIncluir.funcao" type="text" class="form-control" id="idtxtfuncao" aria-describedby="basic-addon3">
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

                        <div class="input-group mb-3">
                            <div v-for="erro in erros" class="row">
                                <div class="col">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Erro:</strong>
                                        {{erro}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div v-for="s in sucessos" class="row">
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
                        </div>
                        <div class="input-group mb-3 justify-content-end">
                            <button v-on:click="incluirNovoEmpregado()" type="button" class="btn btn-success" data-dismiss="modal">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var mixin = {
        methods: {
            incluirNovoEmpregado(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empregado/cadastrar';
                this.empregadoAIncluir.id = '';
                this.empregadoAIncluir.empresa.id = this.empresaSelecionada.id;
                axios.post(url, this.empregadoAIncluir).then(function(r){
                    vm.erros = [];
                    vm.sucessos = ["Empregado incluido com sucesso!"];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.sucessos = [];
                }).finally(function () {
                    
                });
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
    var appNovoEmpregado = new Vue({
        el: "#appNovoEmpregado",
        mixins: [mixin],
        data: {
          erros:[],
          sucessos:[],
          empregadoAIncluir:{
              nome: "",
              cpf: "",
              telefone: "",
              funcao: "",
              empresa:{},
          },
          empresasBuscadas:[],
          txtBuscaEmpresa: "",
          empresaSelecionada: {},
        }
    });
</script>