@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <!-- Section d'annonce -->
    <section class="content-header">
        <h1 class="text-center">Sites</h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Box primaire avec les infos -->
                <div class="box box-primary">
                    <div class="text-2xl">
                        <h4 class="">
                            Le siège de la plateforme de gestion des touristiques & évènements du Bénin est situé en face de l'église des Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO (Godomey), juste après l'École primaire EPP TOGOUDO.
                        </h4>
                    </div>
                </div>

                <!-- Alerte info -->
                <div class="alert alert-info">
                    <h5 class="text-center">NB: Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</h5>
                </div>

                <!-- Formulaire de création du site -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center ">Ajouter un Site</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('sites.traitement') }}" method="post" class="form-horizontal border-solid border-2 shadow p-2" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="nom" class="col-sm-4 col-form-label">Nom du Site<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom du site">
                                    @error('nom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categorie_id" class="col-sm-4 col-form-label">Choisissez la Catégorie</label>
                                <div class="col-sm-8">
                                    <select name="categorie_id" class="form-control" id="categorie_id">
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->types }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pays" class="col-sm-4 col-form-label">Pays<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pays" class="form-control" id="pays" placeholder="Pays">
                                    @error('pays')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="departement" class="col-sm-4 col-form-label">Département<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="departement" class="form-control" id="departement" placeholder="Département">
                                    @error('departement')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="commune" class="col-sm-4 col-form-label">Commune<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="commune" class="form-control" id="commune" placeholder="Commune">
                                    @error('commune')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-sm-4 col-form-label">Photo du Site</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photo" class="form-control" id="photo">
                                    @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-4 col-form-label">Contacts</label>
                                <div class="col-sm-8">
                                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Numéro de contact">
                                    @error('contact')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" mt-2>
                                <label for="description" class="col-sm-4 col-form-label">Description<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <textarea name="description" class="form-control" id="description" placeholder="Description du site"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
