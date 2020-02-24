<template>
<div>
	<b-button block @click="modalShow = !modalShow">{{ task.name }}</b-button>
	<b-modal id="modalPopover" v-model="modalShow" title="Modal with Popover" ok-only>
		<p>
			<label-edit :text="task.name" id="labeledit1" v-on:text-updated="textUpdated" placeholder="Enter some text"></label-edit>
		</p>
	</b-modal>
</div>

</template>
<script>
	import LabelEdit from 'label-edit'
	export default {
		props:['task'],
		 data() {
			return {
				modalShow: false,
				text: 'Click this text!',
			}
		},
		components: {
			LabelEdit
		},
		methods: {
		    textUpdated: function(text){
		      this.text = text;
		    },
		}
	}
</script>