<div id="appNovoFornecedor">
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Incluir novo fornecedor
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container">
                        <!-- INPUT NOME-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome</span>
                            </div>
                                <input v-model="fornecedorAIncluir.nome" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT CNPJ-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblCnpj">CNPJ</span>
                            </div>
                                <input v-model="fornecedorAIncluir.cnpj" type="text" class="form-control" id="idtxtCnpj" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Telefone-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblTelefone">Telefone</span>
                            </div>
                                <input  v-model="fornecedorAIncluir.telefone" type="text" class="form-control" id="idtxtTelefone" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Endereço-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblEndereco">Endereço</span>
                            </div>
                                <input  v-model="fornecedorAIncluir.endereco" type="text" class="form-control" id="idtxtEndereco" aria-describedby="basic-addon3">
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
                            <button v-on:click="incluirNovoFornecedor()" type="button" class="btn btn-success" data-dismiss="modal">Salvar</button>
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
            incluirNovoFornecedor(){
                console.log(this.fornecedorAIncluir);
                var vm = this;
                var url = 'http://' + host + ':8089/api/fornecedor/cadastrar';
                this.fornecedorAIncluir.id = '';
                axios.post(url, this.fornecedorAIncluir).then(function(r){
                    vm.erros = [];
                    vm.sucessos = ["Fornecedor incluido com sucesso!"];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.sucessos = [];
                }).finally(function () {
                    
                });
            }
        }
    }
    var appNovoFornecedor = new Vue({
        el: "#appNovoFornecedor",
        mixins: [mixin],
        data: {
          erros:[],
          sucessos:[],
          fornecedorAIncluir:{},
        }
    });
</script>