<template>
    <div class="mt-3">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>

        <div class=" pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-center">Edit Unit</h1>
        </div>

        <div class="container py-3">
            <div class="row justify-content-center">
               <div class="col-10">
                <form class="mt-3" @submit.prevent="updateUnit">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Company</label>
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
                        <!-- <button area="submit" class="btn btn-danger me-3">Batal</button> -->
                         <Link href="/units" class="btn btn-danger me-3">Batal</Link>
                        <button type="submit" class="btn btn-success">Ubah</button>
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

        components: {
            Link
        },

        props:{
            unit:Object,
            errors:Object,
        },
     
        setup(props){
            const unit=reactive({
                nama:props.unit.nama,
                lantai:props.unit.lantai,
                area:props.unit.area,
            })

            function updateUnit(){
                let nama=unit.nama;
                let lantai=unit.lantai;
                let area=unit.area;
             

                Inertia.put(`/units/${props.unit.id}`, {
                    nama: nama,
                    lantai: lantai,
                    area:area,
                });
            }

            return{
                unit,
                updateUnit
            }
        }
    }
</script>

<style>

</style>