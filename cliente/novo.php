<div id="appNovoCliente">
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Incluir novo Cliente
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="container">
                        <!-- INPUT NOME-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblnome">Nome</span>
                            </div>
                                <input v-model="clienteAIncluir.nome" type="text" class="form-control" id="idtxtNome" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT CPF-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">CPF</span>
                            </div>
                                <input v-model="clienteAIncluir.cpf" type="text" class="form-control" id="idtxtcpf" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT Celular-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcpf">Celular</span>
                            </div>
                                <input v-model="clienteAIncluir.celular" type="text" class="form-control" id="idtxtcelular" aria-describedby="basic-addon3">
                        </div>

                        <!-- INPUT logradouro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlbllogradouro">Logradouro</span>
                            </div>
                                <input v-model="clienteAIncluir.logradouro" type="text" class="form-control" id="idtxtlogradouro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT Bairro-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblbairro">Bairro</span>
                            </div>
                                <input v-model="clienteAIncluir.bairro" type="text" class="form-control" id="idtxtbairro" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT cidade-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblcidade">Cidade</span>
                            </div>
                                <input v-model="clienteAIncluir.cidade" type="text" class="form-control" id="idtxtcidade" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT estado-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblestado">Estado</span>
                            </div>
                                <input v-model="clienteAIncluir.estado" type="text" class="form-control" id="idtxtestado" aria-describedby="basic-addon3">
                        </div>
                        <!-- INPUT email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="idlblemail">Email</span>
                            </div>
                                <input v-model="clienteAIncluir.email" type="text" class="form-control" id="idtxtemail" aria-describedby="basic-addon3">
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
                            <button v-on:click="incluirNovoCliente()" type="button" class="btn btn-success" data-dismiss="modal">Salvar</button>
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
            incluirNovoCliente(){
                var vm = this;
                var url = 'http://' + host + ':8089/api/cliente/cadastrar';
                this.clienteAIncluir.id = '';
                axios.post(url, this.clienteAIncluir).then(function(r){
                    vm.erros = [];
                    vm.sucessos = ["Cliente incluido com sucesso!"];
                }).catch(function (error) {
                        vm.erros = error.response.data.errors;
                        vm.sucessos = [];
                }).finally(function () {
                    
                });
            }
        }
    }
    var appNovoCliente = new Vue({
        el: "#appNovoCliente",
        mixins: [mixin],
        data: {
          erros:[],
          sucessos:[],
          clienteAIncluir:{},
        }
    });
</script>