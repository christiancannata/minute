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
                                    <li class="widget-toggle"><a href="#"  title="Salva">
                                        <i class="zmdi zmdi-storage"></i>
                                    </a>
                                    </li>
                                    <li class="widget-fullscreen"><a href="#" title="Schermo intero"><i class="zmdi zmdi-fullscreen"></i></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div data-mode="edit" data-meeting="" class="os-mac">
                    <header>
                        <p>
                            <input contenteditable="" class="content-editable" type="text" name="project" placeholder="project">
                        </p>

                        <div class="title">
                            <input contenteditable="" class="content-editable" type="text" name="title" placeholder="Title (or Date)">
                        </div>
                        <p>
                            <input contenteditable="" class="content-editable" type="text" name="date" placeholder="Date / Time">
                            |
                            <input contenteditable="" class="content-editable" type="text" name="place" placeholder="Place">
                        </p>

                        <figure style="display:none;" class="stamp">
                            FILED
                            <figcaption>8/20/2014</figcaption>
                        </figure>


                  <div class="logo"></div>


                    </header>

                    <div class="meta">
                        <table class="table">
                            <tbody>
                            <tr class="minuteTaker">
                                <th>Minute Taker</th>
                                <td>
                                    <input contenteditable="" class="content-editable" type="text" name="minuteTaker" placeholder="your name and email address">
                                </td>
                            </tr>
                            <tr class="attendees">
                                <th>Attendees</th>
                                <td>
                                    <input contenteditable="" class="content-editable" type="text" name="minuteTaker" placeholder="names and email addresses">
                                </td>
                            </tr>
                            <tr style="display:none;" class="others">
                                <th>Others</th>
                                <td>
                                    <input contenteditable="" class="content-editable" type="text" name="others" placeholder="names and email addresses">
                                </td>
                            </tr>
                            <tr style="display:none;" class="description">
                                <th>About this meeting</th>
                                <td>
                                    <input contenteditable="" class="content-editable" type="text" name="description" placeholder="description">

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
                                    <input type="text" id="topic1" class="content-editable" name="topic[]" placeholder="Topic">
                                </td>
                                <td class="type">
                                    <select name="type[]" class="todo">
                                        <option value="agenda" class="agenda">AGENDA</option>
                                        <option value="decision" class="decision">DECISION</option>
                                        <option value="done" class="done">DONE</option>
                                        <option value="info" class="info">INFO</option>
                                        <option value="idea" class="idea">IDEA</option>
                                        <option selected="" value="todo" class="todo">TODO</option>
                                    </select>
                                </td>
                                <td class="note">
                                    <input type="text" id="note1" name="note[]" class="content-editable"  placeholder="Note">
                                </td>
                                <td class="owner">
                                    <input type="text" id="owner1" name="owner[]" class="content-editable" placeholder="Initials">
                                </td>
                                <td class="due">
                                    <div>
                                        <div contenteditable="" placeholder="2015-10-23" data-smartdate-spy=""
                                             name="dueAt" data-format="YYYY-MM-DD"></div>
                                        <a class="calendar" href="#">

                                        </a>
                                    </div>
                                </td>
                                <td class="actions">
                                    <span data-remove=""  class="remove-task">×</span>
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
                                <form action="#" class="j-forms" novalidate>

                                    <div class="form-content">

                                        <!-- start textarea -->
                                        <div class="unit">
                                            <label class="label">Textarea</label>

                                            <div class="input">
                                                <label class="icon-left" for="textarea">
                                                    <i class="fa fa-file-text-o"></i>
                                                </label>
                                                <textarea class="form-control" placeholder="your message..."
                                                          spellcheck="false" id="textarea"></textarea>
                                            </div>
                                        </div>
                                        <!-- end textarea -->

                                    </div>
                                    <!-- end /.content -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-success primary-btn processing">
                                            Processing...
                                        </button>
                                        <button type="reset" class="btn btn-danger secondary-btn">Reset</button>
                                        <button type="submit" class="btn btn-info primary-btn">Submit</button>
                                    </div>
                                    <!-- end /.footer -->

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
