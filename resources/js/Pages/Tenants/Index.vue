<template>
    <div class="mt-3">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <div class=" pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-center">Daftar Tenant</h1>
        </div>

        <div class="mb-3">
            <Link href="/tenants/create" class="btn btn-primary">Tambah</Link>
        </div>
        <div class="table-responsive">
                    <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Company</th>
                            <th scope="col">Email</th>
                            <th scope="col">phone</th>
                            <th scope="col">Adress</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(tenant, index) in tenants" :key="tenant.id">
                            <td>{{index+1}}</td>
                            <td>{{tenant.company}}</td>
                            <td>{{tenant.email}}</td>
                            <td>{{tenant.phone}}</td>
                            <td>{{tenant.address}}</td>
                            <td>
                                <Link :href="`/tenants/${tenant.id}/edit`" class="btn btn-primary  me-3 "> Edit</Link>
                                <Link v-on:click="deleteTenant(tenant.id)"  class="btn btn-danger "> Delete</Link>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
    </div>
</template>

<script>
    //import layout
    import LayoutApp from '../../Layouts/App.vue'
    import axios from "axios";
    //import Link dari inertia
    import { Link } from '@inertiajs/inertia-vue3';
   
    export default {

        //layout
        layout: LayoutApp,
        
        //register Link di component
        components: {
            Link,
        },

        //props
        props: {
            tenants: Array // <- nama props yang dibuat di controller saat parsing data
        },
        methods: {
        async deleteTenant(id) {
            if(confirm("Yakin ingin menghapus data?")){
               await axios.delete(`/tenants/${id}`)
               document.location.href="/units";
            }else{
                return false;
            }
        },
    },
    }
</script>

<style>

</style>