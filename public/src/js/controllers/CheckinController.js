(function(){
	angular.module('Check-in').controller('CheckinController', ['Projects', 'Auth', function(projects_service, auth){
		var ctrl = this;
		ctrl.projects = projects_service;
		ctrl.auth = auth;

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
			},

			login: {
				refresh: function(){
					this.data = {};
					this.promise = null;
				},

				submit: function(){
					this.promise = ctrl.auth.login(this.data);
					this.promise.then(function(){
						ctrl.projects.index();
					});
					this.data = {};
				},

				is_disabled: function(){
					return this.promise && !this.promise.$$state.status;
				},

				can_submit: function(){
					return this.data && this.data.email && this.data.password;
				}
			}
		};

		function init(){
			ctrl.forms.login.refresh();
		}
		init();
	}]);
})();