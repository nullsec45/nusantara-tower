<template>
    <div class="mt-3">
        <!-- flash message -->
        <div v-if="$page.props.flash.loginError" class="alert alert-success" role="alert">
            {{ $page.props.flash.loginError }}
        </div>

        <div class=" pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-center">Tambah Tenant</h1>
        </div>

        <div class="container py-3">
            <div class="row justify-content-center">
               <div class="col-10">
                <form class="mt-3" @submit.prevent="storeTenant">
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" placeholder="company" v-model="tenant.company" />
                        <div v-if="errors.company" class="mt-2 alert alert-danger">
                            {{ errors.company }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="email" v-model="tenant.email" />
                        <div v-if="errors.email" class="mt-2 alert alert-danger">
                            {{ errors.email }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="phone" v-model="tenant.phone" />
                        <div v-if="errors.phone" class="mt-2 alert alert-danger">
                            {{ errors.phone }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="address" v-model="tenant.address" />
                        <div v-if="errors.address" class="mt-2 alert alert-danger">
                            {{ errors.address }}
                        </div>
                    </div>
                    <div class="mb-3 float-end">
                       <Link href="/tenants" class="btn btn-danger me-3">Batal</Link>
    
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
            const tenant=reactive({
                company:"",
                email:"",
                phone:"",
                address:""
            })

            function storeTenant(){
                let company=tenant.company;
                let email=tenant.email;
                let phone=tenant.phone;
                let address=tenant.address;

                Inertia.post('/tenants', {
                    company: company,
                    email: email,
                    phone:phone,
                    address:address
                });
            }

            return{
                tenant,
                storeTenant
            }
        }
    }
</script>

<style>

</style>