
require 'fileutils'

def get_static_files
  `git ls-files **/dist/*`
end

def set_assumed_unchanged(files, on)
  if on
    flag = '--assume-unchanged'
  else
    flag = '--no-assume-unchanged'
  end

  sh %{git update-index #{flag} #{files}}
end

def has_changes
  status = `git status --short`
  status.match(/^[MA]/) || status.match(/^.[MA]/)
end

def commit_all(message)
  sh %{git commit --all --message "#{message}"} if has_changes
end

def bump_versions(version)
  sh %{npm version #{version}}
  sh %{bower version #{version}}

  # (npm and bower both automatically commit their changes, with no option not
  # to. And they use different formats for the commit messages. Because they're
  # just helpful like that. SERENITY NOW!)
  sh %{git tag --delete "#{version}"}
  sh %{git tag --delete "v#{version}"}
  sh %{git reset HEAD^^}
  sh %{sed --in-place=.release --expression='s/^version.*/version="#{version}"/' plugin.ini}
  commit_all("Bumped version to #{version}.")
end

def update_i18n()
  sh %{tx pull --force}
  sh %{grunt pot}
  sh %{grunt po2mo}
  commit_all("Updated i18n.")
end

def generate_package()
  static_files = get_static_files
  set_assumed_unchanged(static_files, false)

  sh %{grunt package}
  sh %{git add --force #{static_files}}

  commit_all("Updated assets.")
  set_assumed_unchanged(static_files, true)
end

def release_gbye()
  puts "Done."
  puts "All changes are local."
  puts "Nothing has been pushed."
  puts "You can handle that."
  puts
  puts "    git push"
  puts "    git push --tags"
  puts
  puts "Also, please check the package file before uploading to http://omeka.org/wp-admin."
end

namespace :neatline do
  desc 'Sets up the development environment.'
  task :setup do
    static_files = get_static_files

    sh %{npm install}
    sh %{composer install}
    sh %{grunt build}

    set_assumed_unchanged(static_files, true)
  end

  desc 'Regenerates static files and commits any changes.'
  task :commit_static do
    static_files = get_static_files
    set_assumed_unchanged(static_files, false)

    sh %{grunt compile:min}

    sh %{git add --force #{static_files}}
    commit_all("Committing minified payloads.")

    set_assumed_unchanged(static_files, true)
  end

  desc 'This creates a release branch, processes the release, and closes the branch without pushing it to github.'
  task :release, [:version] do |t, args|
    version = args[:version]

    puts "Releasing Neatline #{version}"

    sh %{git flow release start #{version}}

    bump_versions(version)
    update_i18n()

    # TODO: Include hook for updating CHANGELOG.md

    generate_package()

    puts "Created pkg/Neatline-#{version}.zip"
    sh %{git flow release finish #{version}}

    FileUtils.rm('plugin.ini.release')
    release_gbye()
  end
end
