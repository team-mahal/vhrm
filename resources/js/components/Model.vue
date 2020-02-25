<template>
<div>
	<a block class="text-center" @click="modalShow = !modalShow">{{ task.task_name }}</a>
	<span hred="#" class="badge bg-danger text-white" v-if="task.priority=='high'">{{ task.priority }}</span>
	<span hred="#" class="badge bg-warning text-white" v-else-if="task.priority=='low'">{{ task.priority }}</span>
	<span hred="#" class="badge bg-success text-white" v-else-if="task.priority=='medium'">{{ task.priority }}</span>
	<b-modal id="modalPopover" v-model="modalShow" title="Modal with Popover" ok-only>
		<p>
			<label-edit :text="task.task_name" id="labeledit1" v-on:text-updated="textUpdated" placeholder="Enter some text"></label-edit>
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
		    	console.log(text);
		      this.text = text;
		    },
		}
	}
</script>