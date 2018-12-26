	{!!csrf_field()!!}

    <div class="form-group">
      <label for="name">Nombre:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre aquí" value="{{old('name', $user->name)}}">
    </div>



    <div class="form-group">
      <label for="email">Correo Electrónico:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="user@compañia.com" value="{{old('email', $user->email)}}">
    </div>




  	<div class="form-group">
      <label for="password">Contraseña:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>

    <div class="form-group">
      <label for="name">Bio:</label>
     <textarea name="bio" id="bio" class="form-control">{{ old('bio', $user->profile->bio) }}</textarea>

    </div>

    <div class="form group">
    	<label for="profession_id">Professión</label>
    	<select name="profession_id" id="profession_id" class="form-control">
    		<option value="">Selecciona un valor</option>
    		@foreach($professions as $profession)

    		<option value="{{$profession->id}}"{{ old('profession_id', $user->profile->profession_id) ==$profession->id ? ' selected' : ''}}>{{$profession->title}}</option>
    		@endforeach
    	</select>
    </div>

    <div class="form-group">
      <label for="name">Twitter:</label>
      <input type="text" class="form-control" id="twitter" name="twitter" placeholder="" value={{old('twitter', $user->profile->twitter)}}>
    </div>

	<h4>Habilidades</h4>
	
	@foreach($skills as $skill)
    <div class="form-check form-check-inline">
	  <input name="skills[{{$skill->id}}]" 
	  		class="form-check-input" 
	  		type="checkbox" 
	  		id="skill_{{$skill->id}}" 
	  		value="{{$skill->id}}"
	  		{{$errors->any() ? old("skills.{$skill->id}") : $user->skills->contains($skill) ? 'checked' : ''}}>
	  <label class="form-check-label" for="skill_{{$skill->id}}">{{$skill->name}}</label>
	</div>
	@endforeach

	<h4 class="mt-3">Roles</h4>

	@foreach($roles as $role => $name) 

	<div class="form-check form-check-inline">
	  <input class="form-check-input" 
	  		type="radio" 
	  		name="role" 
	  		id="role_{{$role}}" 
	  		value="{{$role}}"
	  		{{old('role', $user->role) == $role ? 'checked': ''}}>
	  <label class="form-check-label" for="role_{{$role}}">{{$name}}</label>
	</div>

	@endforeach
