<template>
    <div class="mt-3">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>

        <div class=" pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-center">Tambah Unit</h1>
        </div>

        <div class="container py-3">
            <div class="row justify-content-center">
               <div class="col-10">
                <form class="mt-3" @submit.prevent="storeUnit">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Unit</label>
                        <input type="text" class="form-control" id="nama" placeholder="nama" v-model="unit.nama" />
                        <div v-if="errors.nama" class="mt-2 alert alert-danger">
                            {{ errors.nama }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lantai" class="form-label">Lantai</label>
                        <input type="text" class="form-control" id="lantai" placeholder="lantai" v-model="unit.lantai" />
                        <div v-if="errors.lantai" class="mt-2 alert alert-danger">
                            {{ errors.lantai }}
                        </div>
                    </div>  
                    <div class="mb-3">
                        <label for="area" class="form-label">Area</label>
                        <input type="text" class="form-control" id="area" placeholder="area" v-model="unit.area" />
                        <div v-if="errors.area" class="mt-2 alert alert-danger">
                            {{ errors.area }}
                        </div>
                    </div>
                    <div class="mb-3 float-end">
                        <Link href="/units" class="btn btn-danger me-3">Batal</Link>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                    
                </form>

               </div>
            </div>
        </div>
    </div>
</template>

<script>
    //import layout
    import LayoutApp from '../../Layouts/App.vue'
    
    import {reactive} from "vue";
    import {Inertia} from "@inertiajs/inertia";

    import { Link } from '@inertiajs/inertia-vue3';

    export default {

        //layout
        layout: LayoutApp,
        
        props:{
            errors:Object
        },
        //register Link di component
        components: {
            Link
        },

        setup(){
            const unit=reactive({
                nama:"",
                lantai:"",
                area:"",
            })

            function storeUnit(){
                let nama=unit.nama;
                let lantai=unit.lantai;
                let area=unit.area;

                Inertia.post('/units', {
                    nama: nama,
                    lantai: lantai,
                    area:area,
                });
            }
            return{
                unit,
                storeUnit
            }
        }
    }
</script>

<style>

</style>