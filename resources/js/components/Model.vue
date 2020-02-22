<template>
<div>
	<b-button block @click="modalShow = !modalShow">{{ task.name }}</b-button>
	<b-modal id="modalPopover" v-model="modalShow" title="Modal with Popover" ok-only>
		<p>
			{{ task.name }}
		</p>
	</b-modal>
</div>

</template>
<script>
	export default {
		props:['task'],
		 data() {
			return {
				modalShow: false
			}
		}
	}
</script>