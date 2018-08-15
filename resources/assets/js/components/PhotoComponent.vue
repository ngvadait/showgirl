<template>
	<div class="container">
		<div class="row">
			<div v-for="p in photos" class="col-md-4" style="margin: 7px 0px;" v-bind:id="p.id_fb">
				<div style="background: #F1F3F8" data-aos="zoom-in">
					<!--Card image-->
					<img v-img v-bind:src="p.full_picture" v-bind:alt="p.name_fb" style="margin-bottom: 10px" width="100%">
					<!-- Card content -->
					<div style="padding-left: 10px">
					    <!-- Title -->
					    <a class="hide-p" :href="urlFB(p.id_fb)" target="_blank">
					    	<img style="border-radius: 60%;" class="circle float-left" :src="imageFB(p.id_fb)" width="50px" alt="" aria-label="" role="img">
					    </a>
						<p class="float-left" style="padding-left:20px;line-height:50px">
							<a class="hide-p" :href="urlFB(p.id_fb)" target="_blank">{{p.name_fb}}</a>
						</p><br><br><br>
					    <!-- Text -->
					    <p class="card-text" style="padding-bottom: 5px"><a class="hide-a" :href="p.link" target="_blank">{{ p.message }}</a></p>       
					</div>
				</div>
				<br>
			</div>

			<infinite-loading @infinite="infiniteHandler"></infinite-loading>
			<back-to-top>
			  	<img src="/arrow_up.png" width="25px" alt="">
			</back-to-top>	
			
		</div>
	</div>
</template>

<style type="text/css">
	
</style>

<script type="text/javascript">
	import InfiniteLoading from 'vue-infinite-loading';
	import AOS from 'aos';
	import 'aos/dist/aos.css';
	export default {
		data(){
            return {
                photos:{},
            }
        },
        created(){
        	AOS.init();
            this.getPhotos();
        },
		methods: {
			getPhotos: function() {
				axios.get('/photos')
            	.then((response) => this.photos = response.data.data)
            	.catch((error) => console.log(error));
			},
			urlFB: function(id) {
				return 'https://facebook.com/' + id;
		    },
		    imageFB: function(id) {
		    	return 'https://graph.facebook.com/' + id + '/picture?type=large'
		    },
		    infiniteHandler: function($state) {
		    	let limit = this.photos.length / 6 + 1;
		    	axios.get('/photos', { params: { page: limit } })
		    	.then(response => {
		    		this.loadMore($state, response);
		    	});
		    },
		    loadMore: function($state, response) {
		    	if (response.data.data.length) {
		    		this.photos = this.photos.concat(response.data.data);
		    		setTimeout(() => {
			    		$state.loaded();
			    	} ,1000);
			    	if (response.data.total == this.photos.length) {
			    		$state.complete();
			    	}
		    	} else {
		    		$state.complete();
		    	}
		    }
		},
		computed : {
		},
		mounted() {
            
        },
        components: {
    		InfiniteLoading,
  		},
	};
</script>