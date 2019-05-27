<template>
    <div class="landing-wrapper">   <!--parent div-->
        <header-component/>
        <section class="container">
            <div class="row">
                <div class="header">   <!-- vue typer-->
                    <vue-typer :text='["Welcome to Rakitich Hotel!", "Our goal is to serve you better!"]'></vue-typer>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <p class="header-sub-text">We deliver the best hotel services you can think of. We have affordable rooms stocked with various utitlites
                    we know you will need.
                    Our customer service is also available 24/7
                    </p>
                </div>
            </div>
            
    
           
                <button class="btn btn-success btn-block btn-book" @click="showRoomListing()">   <!-- book now button -->
                        Book A Room
                </button>
           
        </section>
    </div>
</template>

<script>

export default {
    data () {
        return {
            banners:[
                {
                    index: 1,
                    image: "/images/1.jpg",
                },
                {
                    index: 2,
                    image: "/images/2.jpg",
                },
                {
                    index: 3,
                    image: "/images/3.jpg",
                },
                {
                    index: 4,
                    image: "/images/4.jpg",
                },
            ]
        }
    },
    mounted() {
        console.log(this.store);
        //this.axios.get('/api/pelumi').then(res=>{ console.log("result is ", res)});
        
    },
    methods: {
        showRoomListing() {
            this.$router.push('/rooms')
        }
    }
}
</script>

<style lang="scss">
.header {
    margin-top: 30px;
}
.vue-typer {
    font-size: 70px; 
    font-weight: 700; 
    .custom.char {
        &.typed {
             color:#00E676 !important;
        }
    } 
}
.header-sub-text {
    color: white;
    font-size: 30px;
}

.image-container {
  
  
  img {
    position: absolute;
    float: left;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    animation-name: multiple-image-crossfade;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
    animation-duration: 8s;
    &:nth-of-type(1) {
      animation-delay: 6s;
    }
    &:nth-of-type(2) {
      animation-delay: 4s;
    }
    &:nth-of-type(3) {
      animation-delay: 2s;
    }
    &:nth-of-type(4) {
      animation-delay: 0;
    }
  }

  p{
      font-size: 100px;
      color: black;
  }
}

@keyframes multiple-image-crossfade {
  0% {
    opacity:1;
  }
  17% {
    opacity:1;
  }
  25% {
    opacity:0;
  }
  92% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}


.landing-wrapper {
  width: 100%;
  height: 100vh;
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/hotel-bg.jpg');
}



.btn-book {
   margin-top: 50px;
   height: 10vh; 
   font-size: 30px;
   font-weight: 300;
}

</style>


