<template>
    <div class="mt-3">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <div class=" pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-center">Daftar Unit</h1>
        </div>

        <div class="mb-3">
            <Link href="/units/create" class="btn btn-primary">Tambah</Link>
        </div>
        <div class="table-responsive">
                    <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Unit</th>
                            <th scope="col">Lantai</th>
                            <th scope="col">Area</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(unit, index) in units" :key="unit.id">
                            <td>{{index+1}}</td>
                            <td>{{unit.nama}}</td>
                            <td>{{unit.lantai}}</td>
                            <td>{{unit.area}}</td>
                            <td>
                                <Link :href="`/units/${unit.id}/edit`" class="btn btn-primary  me-3 "> Edit</Link>
                                <Link v-on:click="deleteUnit(unit.id)"  class="btn btn-danger "> Delete</Link>
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
            units: Array // <- nama props yang dibuat di controller saat parsing data
        },
        methods: {
        async deleteUnit(id) {
            if(confirm("Yakin ingin menghapus data?")){
               await axios.delete(`/units/${id}`)
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