(function(){
	angular.module('Check-in').controller('LoginController', ['Projects', 'Auth', function(projects_service, auth){
		var ctrl = this;
		ctrl.auth = auth;

		ctrl.forms = {
			login: {
				refresh: function(){
					this.data = {};
					this.promise = null;
				},

				submit: function(){
					this.promise = ctrl.auth.login(this.data);
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