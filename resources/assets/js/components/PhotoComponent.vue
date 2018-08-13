<template>
	<div class="container">
		<div class="row">
			<div v-for="p in photos" class="col-md-4 card" v-bind:id="p.from['id']">
				<!--Card image-->
				<a v-bind:href="p.full_picture" v-bind:title="p.from['name']" class="image-link">
					<img v-bind:src="p.full_picture" v-bind:alt="p.from['name']" width="350px" class="card-img-top">
				</a>
				<!-- Card content -->
				<div class="card-body">
				    <!-- Title -->
				    <img class="circle float-left" :src="imageFB(p.from['id'])" width="50px" alt="" aria-label="" role="img">
					<p class="float-left" style="padding-left:20px;line-height:50px">
						<a :href="urlFB(p.from['id'])" target="_blank">{{p.from['name']}}</a>
					</p><br><br><br>
				    <!-- Text -->
				    <p class="card-text">{{ p.message }}</p>        
				</div>
			</div>
		</div>
	</div>
</template>

<style type="text/css">
	
</style>

<script type="text/javascript">
	export default {
		data(){
            return {
                photos:{},
            }
        },
		methods: {
			urlFB: function(id) {
				return 'https://facebook.com/' + id;
		    },
		    imageFB: function(id) {
		    	return 'https://graph.facebook.com/' + id + '/picture?type=large'
		    }
		},
		computed : {

		},
		mounted() {
            
        },
        created(){
            axios.get('http://127.0.0.1:8000/photos')
            .then((response) => this.photos = response.data)
            .catch((error) => console.log(error));
            console.log("Tasks Component Loaded...");
        }
	};
</script>