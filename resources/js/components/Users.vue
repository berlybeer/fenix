<template>
    <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 270px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>

                     <div class="input-group-append">
                     <button class="btn btn-success" data-toggle="modal" data-target="#addNew">Add New<i class="fa fa-user-plus"></i></button>
                    </div>


                  </div>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>
     
                  <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type|upText}}</td>
                    <td>{{user.created_at|myDate}}</td>
                    <td>
                        <a href="#">Edit
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a href="#">Trash
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form @submit.prevent="createUser">
                  <div class="modal-body">
                      <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                          placeholder="Name" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div> 

                      <div class="form-group">
                        <input v-model="form.email" type="email" name="email"
                          placeholder="Email Address" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                      </div> 

                      <div class="form-group">
                        <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="Short bio for user (Optional)" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                        <has-error :form="form" field="bio"></has-error>
                      </div>

                      <div class="form-group">
                        <select v-model="form.type" type="text" name="type" id="type"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                          <option value="">Select User Role</option>
                          <option value="admin">Admin</option>
                          <option value="user">Standard User</option>
                          <option value="author">Author</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                      </div>


                      <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                      </div>  

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
                  </div>

                  </form>
                </div>
              </div>
            </div>
       </div>


</template>

<script>
    export default {
      data(){
        return{
          users : {},
          form: new Form({
              name : '',
              email: '',
              password: '',
              type: '',
              bio: '',
              photo: ''
          })
        }
      },
      methods:{
        loadUsers(){
          axios.get("api/user").then(({data}) => (this.users = data.data));
        },
        createUser(){
          this.$Progress.start();
          this.form.post('api/user');
          this.$Progress.finish();
        }
      },
      created() {
          this.loadUsers();
      }
    }
</script>
