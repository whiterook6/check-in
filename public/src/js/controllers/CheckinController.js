(function(){
	angular.module('Check-in').controller('CheckinController', ['Projects', function(projects_service){
		var ctrl = this;
		ctrl.projects = projects_service;

		ctrl.forms = {
			new_project: {
				refresh: function(){
					ctrl.forms.new_project.data = {};
					ctrl.forms.new_project.promise = null;
				},

				submit: function(){
					var promise = ctrl.projects.create(this.data);
					promise.then(function(){
						ctrl.forms.new_project.data = {};
					});
					this.promise = promise;
				},

				is_disabled: function(){
					return this.promise && !this.promise.$$state.status;
				},

				can_submit: function(){
					return this.data && this.data.name;
				}
			}
		};

		function init(){
			var sort_recent = {
				order_by: 'created_at',
				order_direction: 'desc'
			};

			ctrl.projects.index(sort_recent);
			ctrl.designs.index(sort_recent);
			ctrl.versions.index(sort_recent);
			ctrl.forms.new_project.refresh();
		}
		init();
	}]);
})();