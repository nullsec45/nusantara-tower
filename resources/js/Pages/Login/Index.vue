<style scoped>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

    </style>

<template>
    <div>
        <main class="form-signin w-100 m-auto mt-5">
            <form @submit.prevent="login">
                <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
                <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
                  {{ $page.props.flash.message }}
              </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="auth.email">
                    <label for="floatingInput">Email address</label>
                    <div v-if="errors.email" class="mt-2 alert alert-danger">
                            {{ errors.email }}
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="auth.password">
                    <label for="floatingPassword">Password</label>
                    <div v-if="errors.password" class="mt-2 alert alert-danger">
                            {{ errors.password }}
                    </div>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
             
            </form>
        </main>
    </div>
</template>

<script>
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

export default{
    
        
        props:{
            errors:Object
        },

        setup(){
            const auth=reactive({
                email:"",
                password:""
            })

            function login(){
                let email=auth.email;
                let password=auth.password;

                Inertia.post('/login', {
                    email: email,
                    password:password
                });
            }

            return{
                auth,
                login
            }
        }
}
</script>