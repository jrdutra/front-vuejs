<div id="appNovaEmpresa">
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Incluir nova empresa
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container">
                        <!-- INPUT Fantasia-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome Fantasia</span>
                            </div>
                                <input v-model="empresaAIncluir.nomeFantasia" type="text" class="form-control" id="idtxtNomeFantasia" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Razao Social-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblrazaoSocial">Razão Social</span>
                            </div>
                                <input v-model="empresaAIncluir.razaoSocial" type="text" class="form-control" id="idtxtRazaoSocial" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT CNPJ-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcnpj">Cnpj</span>
                            </div>
                                <input v-model="empresaAIncluir.cnpj" type="text" class="form-control" id="idtxtCnpj" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Logradouro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbllogradouro">Logradouro</span>
                            </div>
                                <input v-model="empresaAIncluir.logradouro" type="text" class="form-control" id="idtxtLogradouro" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Bairro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblBairro">Bairro</span>
                            </div>
                                <input v-model="empresaAIncluir.bairro" type="text" class="form-control" id="idtxtbairro" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Cidade-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblCidade">Cidade</span>
                            </div>
                                <input v-model="empresaAIncluir.cidade" type="text" class="form-control" id="idtxtcidade" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Estado-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblEstado">Estado</span>
                            </div>
                                <input v-model="empresaAIncluir.estado" type="text" class="form-control" id="idtxtestado" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblEmail">Email</span>
                            </div>
                                <input v-model="empresaAIncluir.email" type="text" class="form-control" id="idtxtemail" aria-describedby="basic-addon3">
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
                            <button v-on:click="incluirNovaEmpresa()" type="button" class="btn btn-success" data-dismiss="modal">Salvar</button>
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
            incluirNovaEmpresa(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/empresa/cadastrar';
                this.empresaAIncluir.id = '';
                axios.post(url, this.empresaAIncluir).then(function(r){
                    vm.erros = [];
                    vm.sucessos = ["Empresa incluida com sucesso!"];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.sucessos = [];
                }).finally(function () {
                    
                });
            }
        }
    }
    var appNovaEmpresa = new Vue({
        el: "#appNovaEmpresa",
        mixins: [mixin],
        data: {
          erros:[],
          sucessos:[],
          empresaAIncluir:{},
        }
    });
</script>