<template>
    <div class="landing-wrapper">   <!--parent div-->
        <header-component/>
        <section>
            <div>   <!-- vue typer-->

            </div>
    
            <router-link to="/rooms">
             <div class="btn-book">   <!-- book now button -->
                
                    Book A Room
                
            </div>
            </router-link>
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
        
    }
}
</script>

<style lang="scss" scoped>
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
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/landing-page-hotel.jpg');
}



.btn-book {
    width: 50%;
    color: white;
    margin: 0 auto;
    text-align: center;
    border-width: 2px;
    background-color: #00E676;
}

</style>


