<template>
	<div class="row">
		<div class="col-md-6">
			<multiselect v-model="value" :options="options"></multiselect>
		</div>
	</div>
</template>

<script>

	export default {
		data () {
	      	return {
	        	value: null,
	        	options: ['list', 'of', 'options']
	      	}
	    }
	}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>