<div class="container-fluid">
    <div class="page-header filled full-block light">
        <div class="row">
            <div class="col-md-6">
                <h2>Nuova Board</h2>

                <p>All kind of form elements here </p>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <li><a href="#">Home <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="#">Forms <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li class="active-page"> Form Elements</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget-wrap">
                <div class="widget-header block-header margin-bottom-0 clearfix">

                    <div class="pull-right w-action">
                        <ul class="widget-action-bar">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="zmdi zmdi-more"></i></a>
                                <ul class="dropdown-menu" style="min-width: 131px !important;">
                                    <li class="widget-reload"><a href="#"><i class="zmdi zmdi-refresh-alt"></i></a></li>
                                    <li class="widget-toggle"><a href="#" title="Salva">
                                        <i class="zmdi zmdi-storage"></i>
                                    </a>
                                    </li>
                                    <li class="widget-fullscreen"><a href="#" title="Schermo intero"><i
                                            class="zmdi zmdi-fullscreen"></i></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <form action="" class="j-forms" novalidate>
                    <div data-mode="edit" data-meeting="" class="os-mac">

                        <header>
                            <p>
                                <input contenteditable="" class="content-editable" type="text" name="project"
                                       placeholder="project">
                            </p>

                            <div class="title">
                                <input contenteditable="" class="content-editable" type="text" name="title"
                                       placeholder="Title (or Date)">
                            </div>
                            <p>
                                <input contenteditable="" class="content-editable" type="text" name="date"
                                       placeholder="Date / Time">
                                |
                                <input contenteditable="" class="content-editable" type="text" name="place"
                                       placeholder="Place">
                            </p>

                            <figure style="display:none;" class="stamp">
                                FILED
                                <figcaption>8/20/2014</figcaption>
                            </figure>


                            <div class="logo"></div>


                        </header>

                        <div class="meta">
                            <table class="table description-page">
                                <tbody>
                                <tr class="minuteTaker">
                                    <th>Minute Taker</th>
                                    <td>
                                        <input  contenteditable="" class="content-editable" type="text"
                                               name="minuteTaker" placeholder="your name and email address">
                                    </td>
                                </tr>
                                <tr class="attendees">
                                    <th>Attendees</th>
                                    <td>
                                        <input style="width:100%" contenteditable="" class="content-editable" type="text"
                                               name="minuteTaker" placeholder="names and email addresses">
                                    </td>
                                </tr>
                                <tr style="display:none;" class="others">
                                    <th>Others</th>
                                    <td>
                                        <input style="width:100%" contenteditable="" class="content-editable" type="text" name="others"
                                               placeholder="names and email addresses">
                                    </td>
                                </tr>
                                <tr style="display:none;" class="description">
                                    <th>About this meeting</th>
                                    <td>
                                        <input style="width:100%" contenteditable="" class="content-editable" type="text"
                                               name="description" placeholder="description">

                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <dl class="toggleMetaFields">
                                <!-- <dt>add:</dt> -->
                                <dd data-toggle="others">Others</dd>
                                <dd data-toggle="description">About this meeting</dd>
                            </dl>
                        </div>

                        <div class="minutes">
                            <table class="table" data-navigable-spy="" data-editable-spy="" data-editable="">
                                <thead>
                                <tr>
                                    <th class="topic">Topic</th>
                                    <th class="type">Type</th>
                                    <th class="note">Note</th>
                                    <th class="owner">Owner</th>
                                    <th class="due">Due</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- The last <tr> in the <tbody> will be used as template for new rows -->
                                <tr data-type="todo" class="clone-row">
                                    <td class="topic">
                                        <input type="text" id="topic1" class="content-editable" name="topic[]"
                                               placeholder="Topic">
                                    </td>
                                    <td class="type">
                                        <select name="type[]" class="todo">
                                            <option data-color="red" value="agenda" class="agenda" selected>AGENDA
                                            </option>
                                            <option data-color="yellow" value="decision" class="decision">DECISION
                                            </option>
                                            <option data-color="blue" value="done" class="done">DONE</option>
                                            <option data-color="green" value="info" class="info">INFO</option>
                                            <option data-color="grey" value="idea" class="idea">IDEA</option>
                                            <option data-color="lightorange" value="todo" class="todo">TODO</option>
                                        </select>
                                    </td>
                                    <td class="note">
                                        <input type="text" id="note1" name="note[]" class="content-editable"
                                               placeholder="Note">
                                    </td>
                                    <td class="owner">
                                        <input type="text" id="owner1" name="owner[]" class="content-editable"
                                               placeholder="Initials">
                                    </td>
                                    <td class="due">
                                        <div>
                                            <input type="text" id="due1" name="due[]" class="content-editable input-date-picker"
                                                   placeholder="gg/mm/aaaa" readonly>
                                            <a class="calendar">
                                                <svg viewBox="0 0 16 16" height="16" width="16" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" version="1.1">
                                                    <path fill="#ffffff" d="M14 2h-1.5v0.5c0 0.551-0.449 1-1 1s-1-0.449-1-1v-0.5h-5v0.5c0 0.551-0.449 1-1 1s-1-0.449-1-1v-0.5h-1.5c-0.55 0-1 0.45-1 1v11c0 0.55 0.45 1 1 1h12c0.55 0 1-0.45 1-1v-11c0-0.55-0.45-1-1-1zM14 13.998c-0.001 0.001-0.001 0.001-0.002 0.002h-11.996c-0.001-0.001-0.001-0.001-0.002-0.002v-8.998h12v8.998zM4.5 3c0.276 0 0.5-0.224 0.5-0.5v-2c0-0.276-0.224-0.5-0.5-0.5s-0.5 0.224-0.5 0.5v2c0 0.276 0.224 0.5 0.5 0.5zM11.5 3c0.276 0 0.5-0.224 0.5-0.5v-2c0-0.276-0.224-0.5-0.5-0.5s-0.5 0.224-0.5 0.5v2c0 0.276 0.224 0.5 0.5 0.5zM9 6h-5v1h4v2h-4v1h4v2h-4v1h5zM11 13h1v-7h-2v1h1zM13.625 15.375h-11.25c-0.55 0-1-0.325-1-0.875v0.5c0 0.55 0.45 1 1 1h11.25c0.55 0 1-0.45 1-1v-0.5c0 0.55-0.45 0.875-1 0.875z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="actions">
                                        <a class="row-delete remove-task" href="#">
                                            <span class="zmdi zmdi-close"></span>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="widget-container">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-footer">

                                        <button type="reset" class="btn btn-danger secondary-btn reset">Reset</button>
                                        <button type="submit" class="btn btn-info primary-btn save">Salva</button>
                                        <button type="submit" class="btn btn-info primary-btn save">Salva e Invia</button>
                                        <button type="submit" class="btn btn-success primary-btn processing hide">
                                            Salvataggio in corso...
                                        </button>
                                    </div>
                                    <!-- end /.footer -->
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>


        </div>
    </div>

</div>
